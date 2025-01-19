// SPDX-License-Identifier: MIT
pragma solidity ^0.8.4;

import "@openzeppelin/contracts/token/ERC20/ERC20.sol";
import "@openzeppelin/contracts/token/ERC721/IERC721.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

contract FractionalNFT is ERC20, Ownable {
    address public nftAddress;    // Address of the original NFT
    uint256 public tokenId;       // ID of the NFT (for reference)
    uint256 public galleryShare;  // Number of tokens allocated to gallery
    address public galleryAddress;
    address public salesContract;

    bool public isInitialized = false;

    event Initialized(
        address nftAddress,
        uint256 tokenId,
        address galleryAddress,
        uint256 totalSupply,
        uint256 galleryShare,
        address salesContract
    );
    event NFTFractionalized(uint256 totalSupply, uint256 galleryShare);
    event TokensTransferredToSalesContract(uint256 amount);

    constructor(string memory name, string memory symbol) ERC20(name, symbol) {}

    function initialize(
        address _galleryAddress,
        address _nftAddress,
        uint256 _tokenId,
        uint256 totalSupply,
        uint256 _galleryShare,
        address _salesContract
    ) external onlyOwner {
        require(!isInitialized, "Already initialized");
        require(totalSupply > 0, "Total supply must be greater than zero");
        require(_galleryShare <= totalSupply, "Gallery share exceeds total supply");
        require(_salesContract != address(0), "Invalid sales contract address");

        nftAddress = _nftAddress;
        tokenId = _tokenId;
        galleryAddress = _galleryAddress;
        galleryShare = _galleryShare;
        salesContract = _salesContract;

        // Check ownership with error handling
        bool ownsNFT = _safeCheckNFTOwnership(_nftAddress, _tokenId, _galleryAddress);
        require(ownsNFT, "NFT must be owned by gallery");

        // Mint the total supply to the contract itself
        _mint(address(this), totalSupply);
        isInitialized = true;

        emit Initialized(
            nftAddress,
            tokenId,
            galleryAddress,
            totalSupply,
            galleryShare,
            salesContract
        );
    }

    function allocateGalleryShare() external onlyOwner {
        require(isInitialized, "Contract not initialized");
        require(galleryShare > 0, "No gallery share to allocate");
        require(balanceOf(address(this)) >= galleryShare, "Insufficient tokens");

        _transfer(address(this), galleryAddress, galleryShare);

        emit NFTFractionalized(totalSupply(), galleryShare);
        galleryShare = 0; // Prevent reallocation
    }

    function transferToSalesContract(uint256 amount) external onlyOwner {
        require(isInitialized, "Contract not initialized");
        require(salesContract != address(0), "Sales contract not set");
        require(balanceOf(address(this)) >= amount, "Insufficient tokens");

        _transfer(address(this), salesContract, amount);

        emit TokensTransferredToSalesContract(amount);
    }

    function getAvailableTokens() external view returns (uint256) {
        return balanceOf(address(this));
    }

    function _beforeTokenTransfer(
        address from,
        address to,
        uint256 amount
    ) internal override {
        require(
            to == address(0) || // Allow burning
            to == salesContract || // Allow transfers to the sales contract
            to == galleryAddress || //Allow transfers to gallery address
            from == address(0), // Allow minting
            "Transfers restricted to the sales contract"
        );
        super._beforeTokenTransfer(from, to, amount);
    }

    // Safe NFT ownership check with error handling
    function _safeCheckNFTOwnership(
        address _nftAddress,
        uint256 _tokenId,
        address _owner
    ) internal view returns (bool) {
        try IERC721(_nftAddress).ownerOf(_tokenId) returns (address currentOwner) {
            return currentOwner == _owner;
        } catch {
            return false; // Treat failure as "not owned"
        }
    }

    // Safe balance check for ERC20 tokens
    function _safeBalanceCheck(address _account) internal view returns (uint256) {
        try this.balanceOf(_account) returns (uint256 balance) {
            return balance;
        } catch {
            return 0; // Return zero balance on failure
        }
    }
}
