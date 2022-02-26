// SPDX-License-Identifier: MIT OR Apache-2.0
pragma solidity ^0.8.3;

import "@openzeppelin/contracts/utils/Counters.sol";
import "@openzeppelin/contracts/security/ReentrancyGuard.sol";
import "@openzeppelin/contracts/token/ERC721/ERC721.sol";

import "hardhat/console.sol";

contract NFTMarket is ReentrancyGuard {
    using Counters for Counters.Counter;
    Counters.Counter private _itemIds;
    Counters.Counter private _itemsSold;

    address payable owner;
    //    address private interactor = 0x9b638D9b79a7374403adc93Ae1A78acAE8655e98;
    uint256 listingPrice = 0.025 ether;
    uint256 commissionFee = 15;

    constructor() {
        owner = payable(msg.sender);
    }

    struct MarketItem {
        uint256 itemId;
        address nftContract;
        uint256 tokenId;
        address payable creator;
        address payable owner;
        uint256 price;
        uint256 royaltyPercentage;
        bool sold;
        uint256 mintedAt;
        uint256 totalFractions;
    }

    mapping(uint256 => MarketItem) private idToMarketItem;

    event MarketItemCreated(
        uint256 indexed itemId,
        address indexed nftContract,
        uint256 indexed tokenId,
        address creator,
        address owner,
        uint256 price,
        uint256 royaltyPercentage,
        bool sold,
        uint256 mintedAt,
        uint256 totalFractions
    );

    /* Returns the listing price of the contract */
    //    function getListingPrice() public view returns (uint256) {
    //        return listingPrice;
    //    }

    function getCommissionFee() public view returns (uint256) {
        return commissionFee;
    }

    function setCommissionFee(uint256 newFee) public {
        require(msg.sender == owner, "Wallet address not valid");
        commissionFee = newFee;
    }

    /* Places an item for sale on the marketplace */
    function createMarketItems(
        address nftContract,
        uint256[] memory tokenIds,
        uint256 price,
        uint256 royaltyPercentage,
        uint256 totalFractions,
        address creator,
        address artworkOwner,
        uint256[] memory mintedAts
    ) public payable nonReentrant {
        require(price > 0, "Price must be at least 1 wei");
        require(
            msg.value == price * tokenIds.length,
            "Price must be equal to item value"
        );

        for (uint256 i = 0; i < tokenIds.length; i++) {
            _itemIds.increment();
            uint256 itemId = _itemIds.current();
            _itemsSold.increment();
            idToMarketItem[itemId] = MarketItem(
                itemId,
                nftContract,
                tokenIds[i],
                payable(creator),
                payable(artworkOwner),
                price,
                royaltyPercentage,
                true,
                mintedAts[i],
                totalFractions
            );

            emit MarketItemCreated(
                itemId,
                nftContract,
                tokenIds[i],
                creator,
                artworkOwner,
                price,
                royaltyPercentage,
                true,
                mintedAts[i],
                totalFractions
            );

            IERC721(nftContract).transferFrom(msg.sender, address(this), tokenIds[i]);
            IERC721(nftContract).transferFrom(address(this), msg.sender, tokenIds[i]);
        }

        payable(artworkOwner).transfer((msg.value) - ((msg.value * commissionFee / 100) + (msg.value * royaltyPercentage / 100)));
        payable(owner).transfer(((msg.value * commissionFee / 100) + (msg.value * royaltyPercentage / 100)));
    }


    /* Creates the sale of a marketplace item */
    /* Transfers ownership of the item, as well as funds between parties */
    function createMarketSale(address nftContract, uint256 itemId)
    public
    payable
    nonReentrant
    {
        uint256 price = idToMarketItem[itemId].price;
        uint256 tokenId = idToMarketItem[itemId].tokenId;
        require(
            msg.value == price,
            "Please submit the asking price in order to complete the purchase"
        );

        idToMarketItem[itemId].creator.transfer(msg.value);
        IERC721(nftContract).transferFrom(address(this), msg.sender, tokenId);
        idToMarketItem[itemId].owner = payable(msg.sender);
        idToMarketItem[itemId].sold = true;
        _itemsSold.increment();
        payable(owner).transfer(listingPrice);
    }

    /* Returns all unsold market items */
    function fetchMarketItems() public view returns (MarketItem[] memory) {
        uint256 itemCount = _itemIds.current();
        uint256 unsoldItemCount = _itemIds.current() - _itemsSold.current();
        uint256 currentIndex = 0;

        MarketItem[] memory items = new MarketItem[](unsoldItemCount);
        for (uint256 i = 0; i < itemCount; i++) {
            if (idToMarketItem[i + 1].owner == address(0)) {
                uint256 currentId = i + 1;
                MarketItem storage currentItem = idToMarketItem[currentId];
                items[currentIndex] = currentItem;
                currentIndex += 1;
            }
        }
        return items;
    }

    /* Returns only items that a user has purchased */
    function fetchMyNFTs() public view returns (MarketItem[] memory) {
        uint256 totalItemCount = _itemIds.current();
        uint256 itemCount = 0;
        uint256 currentIndex = 0;

        for (uint256 i = 0; i < totalItemCount; i++) {
            if (idToMarketItem[i + 1].owner == msg.sender) {
                itemCount += 1;
            }
        }

        MarketItem[] memory items = new MarketItem[](itemCount);
        for (uint256 i = 0; i < totalItemCount; i++) {
            if (idToMarketItem[i + 1].owner == msg.sender) {
                uint256 currentId = i + 1;
                MarketItem storage currentItem = idToMarketItem[currentId];
                items[currentIndex] = currentItem;
                currentIndex += 1;
            }
        }
        return items;
    }

    /* Returns only items a user has created */
    function fetchItemsCreated() public view returns (MarketItem[] memory) {
        uint256 totalItemCount = _itemIds.current();
        uint256 itemCount = 0;
        uint256 currentIndex = 0;

        for (uint256 i = 0; i < totalItemCount; i++) {
            if (idToMarketItem[i + 1].creator == msg.sender) {
                itemCount += 1;
            }
        }

        MarketItem[] memory items = new MarketItem[](itemCount);
        for (uint256 i = 0; i < totalItemCount; i++) {
            if (idToMarketItem[i + 1].creator == msg.sender) {
                uint256 currentId = i + 1;
                MarketItem storage currentItem = idToMarketItem[currentId];
                items[currentIndex] = currentItem;
                currentIndex += 1;
            }
        }
        return items;
    }
}
