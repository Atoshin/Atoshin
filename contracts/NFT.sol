// SPDX-License-Identifier: MIT OR Apache-2.0
pragma solidity ^0.8.3;

import "@openzeppelin/contracts/utils/Counters.sol";
import "@openzeppelin/contracts/token/ERC721/extensions/ERC721URIStorage.sol";
import "@openzeppelin/contracts/token/ERC721/ERC721.sol";

import "hardhat/console.sol";

contract NFT is ERC721URIStorage {
    using Counters for Counters.Counter;
    Counters.Counter private _tokenIds;
    address contractAddress;

    constructor(address marketplaceAddress) ERC721("Atoshin", "KIYOSUMI") {
        contractAddress = marketplaceAddress;
    }

    function createToken(string memory tokenURI) public returns (uint) {
        _tokenIds.increment();
        uint256 newItemId = _tokenIds.current();

        _mint(contractAddress, newItemId);
        _setTokenURI(newItemId, tokenURI);
        setApprovalForAll(contractAddress, true);
        return newItemId;
    }


    function createTokens(string[] memory tokenURIs, address gallery, uint ownershipPercentage) public returns (uint) {
        require(((tokenURIs.length * ownershipPercentage) / 100) % 1 == 0, "the modulus of total amount of tokens divided by the ownership percentage must be 0");
        uint prevId = _tokenIds.current();
        uint galleryTokensLength = ((tokenURIs.length * ownershipPercentage) / 100) - 1;
        for (uint256 i = tokenURIs.length - 1; i >= 0; i--) {
            _tokenIds.increment();
            uint256 newItemId = _tokenIds.current();
            if (i == galleryTokensLength) {
                _mint(gallery, newItemId);
                galleryTokensLength--;
            } else {
                _mint(contractAddress, newItemId);
            }
            _setTokenURI(newItemId, tokenURIs[i]);
            setApprovalForAll(contractAddress, true);
        }
        return prevId;
    }
}
