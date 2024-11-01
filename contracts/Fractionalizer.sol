// SPDX-License-Identifier: MIT
pragma solidity ^0.8.4;

import "@openzeppelin/contracts/token/ERC20/ERC20.sol";
import "@openzeppelin/contracts/token/ERC721/IERC721.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

// Custom ERC20 token for each fractionalized NFT
contract FractionToken is ERC20 {
    constructor(
        string memory name,
        string memory symbol,
        uint256 initialSupply,
        address owner
    ) ERC20(name, symbol) {
        _mint(owner, initialSupply);
    }
}

// Main fractionalization contract
contract NFTFractionalizer is Ownable {
    struct FractionInfo {
        address tokenAddress;      // Address of the fraction token
        address nftAddress;        // Address of the original NFT
        uint256 tokenId;          // ID of the NFT (for reference)
        uint256 totalSupply;      // Total supply of fraction tokens
        uint256 galleryShare;     // Number of tokens allocated to gallery
        uint256 atoshinShare;     // Number of tokens allocated to Atoshin
        bool isActive;            // Whether the fractionalization is active
    }

    mapping(address => FractionInfo) public fractionInfos;
    address public galleryAddress;

    event NFTFractionalized(
        address indexed fractionToken,
        address indexed nftAddress,
        uint256 indexed tokenId,
        uint256 totalSupply,
        uint256 galleryShare,
        uint256 atoshinShare
    );

    constructor(address _galleryAddress) {
        galleryAddress = _galleryAddress;
    }

    function fractionalize(
        address nftAddress,
        uint256 tokenId,
        string memory tokenName,
        string memory tokenSymbol,
        uint256 totalSupply,
        uint256 galleryShare,
        uint256 atoshinShare
    ) external returns (address) {
        require(galleryShare <= totalSupply, "Gallery share cannot exceed total supply");
        require(atoshinShare <= totalSupply, "Atoshin share cannot exceed total supply");
        require(
            IERC721(nftAddress).ownerOf(tokenId) == galleryAddress,
            "NFT must be owned by gallery"
        );

        // Create new fraction token
        FractionToken newToken = new FractionToken(
            tokenName,
            tokenSymbol,
            totalSupply,
            address(this)
        );

        // Store fraction information
        fractionInfos[address(newToken)] = FractionInfo({
            tokenAddress: address(newToken),
            nftAddress: nftAddress,
            tokenId: tokenId,
            totalSupply: totalSupply,
            galleryShare: galleryShare,
            atoshinShare:atoshinShare,
            isActive: true
        });

        // Transfer gallery's share
        if (galleryShare > 0) {
            newToken.transfer(galleryAddress, galleryShare);
        }
        if(atoshinShare > 0){
            newToken.transfer(msg.sender,atoshinShare);
        }

        emit NFTFractionalized(
            address(newToken),
            nftAddress,
            tokenId,
            totalSupply,
            galleryShare,
            atoshinShare
        );

        return address(newToken);
    }

    function transferToSalesContract(
        address fractionToken,
        address salesContract,
        uint256 amount
    ) external onlyOwner {
        require(fractionInfos[fractionToken].isActive, "Fractionalization not active");
        FractionToken(fractionToken).transfer(salesContract, amount);
    }

    // Function to update gallery address
    function setGalleryAddress(address _newGalleryAddress) external onlyOwner {
        galleryAddress = _newGalleryAddress;
    }

    // Function to deactivate fractionalization
    function deactivateFractionalization(address fractionToken) external onlyOwner {
        FractionInfo storage info = fractionInfos[fractionToken];
        require(info.isActive, "Fractionalization not active");
        info.isActive = false;
    }

    // View function to get remaining tokens in contract
    function getAvailableTokens(address fractionToken) external view returns (uint256) {
        require(fractionInfos[fractionToken].isActive, "Fractionalization not active");
        return FractionToken(fractionToken).balanceOf(address(this));
    }
}
