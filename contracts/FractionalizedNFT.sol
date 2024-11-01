// SPDX-License-Identifier: MIT
pragma solidity ^0.8.4;

import "@openzeppelin/contracts/token/ERC20/ERC20.sol";
import "@openzeppelin/contracts/token/ERC721/IERC721.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

contract FractionalizedNFTToken is ERC20, Ownable {
    address public nftAddress;
    uint256 public nftId;

    constructor(
        string memory tokenName,
        uint256 fractions,
        address ownerAddress,
        uint256 ownerShare
    )
    ERC20(string(abi.encodePacked("Atoshin_", tokenName)), "ATF")
    {
        // Mint the total number of fractions
        _mint(address(this), fractions);

        // Transfer the owner's share to their address
        transfer(ownerAddress, ownerShare);
    }
}

contract Fractionalizer is Ownable {
    IERC721 public nftContract;

    // Mappings to track token information
    mapping(uint256 => address) public fractionalTokenAddress;
    mapping(uint256 => uint256) public ownerShares;
    mapping(uint256 => uint256) public remainingForSale;

    event Fractionalized(
        address indexed owner,
        uint256 indexed nftId,
        address tokenAddress,
        uint256 fractions,
        uint256 ownerShare
    );

    constructor(address _nftContract) {
        nftContract = IERC721(_nftContract);
    }

    function fractionalizeNFT(
        uint256 nftId,
        string memory tokenName,
        uint256 fractions,
        address ownerAddress,
        uint256 ownerShare
    ) external onlyOwner {
        require(ownerAddress != address(0), "Invalid owner address");
        require(ownerShare <= fractions, "Owner share exceeds fractions");

        // Verify that the owner of the NFT is calling the function
        require(
            nftContract.ownerOf(nftId) == ownerAddress,
            "Caller is not the owner of the NFT"
        );

        // No need to transfer the NFT, just verify ownership

        // Deploy the new ERC20 token specific to this NFT
        FractionalizedNFTToken fractionalToken = new FractionalizedNFTToken(
            tokenName,
            fractions,
            ownerAddress,
            ownerShare
        );

        // Save the ERC-20 token contract address for this NFT ID
        fractionalTokenAddress[nftId] = address(fractionalToken);

        // Save the owner's share and the tokens available for sale
        ownerShares[nftId] = ownerShare;
        remainingForSale[nftId] = fractions - ownerShare;

        // Emit event for fractionalization
        emit Fractionalized(
            ownerAddress,
            nftId,
            address(fractionalToken),
            fractions,
            ownerShare
        );
    }

    // Function to get the remaining tokens for sale for an NFT
    function getRemainingForSale(uint256 nftId) external view returns (uint256) {
        return remainingForSale[nftId];
    }

    // Function to get the owner's share of tokens for an NFT
    function getOwnerShare(uint256 nftId) external view returns (uint256) {
        return ownerShares[nftId];
    }

    // Function to get the ERC-20 token address for an NFT ID
    function getFractionalTokenAddress(uint256 nftId) external view returns (address) {
        return fractionalTokenAddress[nftId];
    }
}
