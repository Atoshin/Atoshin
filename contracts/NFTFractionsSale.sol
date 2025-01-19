// SPDX-License-Identifier: MIT
pragma solidity ^0.8.4;

import "@openzeppelin/contracts/token/ERC20/IERC20.sol";
import "@openzeppelin/contracts/security/ReentrancyGuard.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

contract FractionSales is ReentrancyGuard, Ownable {
    struct SaleInfo {
        uint256 price;            // Price per token in wei
        uint256 minPurchase;      // Minimum purchase amount
        uint256 maxPurchase;      // Maximum purchase amount
        bool isActive;            // Whether the sale is active
    }

    struct AuctionInfo {
        uint256 startingPrice;    // Starting price in wei
        uint256 minIncrement;     // Minimum bid increment
        uint256 duration;         // Auction duration in seconds
        uint256 endTime;          // Auction end timestamp
        address highestBidder;    // Address of highest bidder
        uint256 highestBid;       // Highest bid amount
        uint256 tokenAmount;      // Amount of tokens being auctioned
        bool isActive;            // Whether the auction is active
        bool claimed;             // Whether the tokens have been claimed
    }

    mapping(address => SaleInfo) public sales;              // Token address => SaleInfo
    mapping(address => AuctionInfo) public auctions;        // Token address => AuctionInfo
    mapping(address => mapping(address => uint256)) public pendingReturns; // Token => Bidder => Amount

    event SaleCreated(address indexed token, uint256 price, uint256 minPurchase, uint256 maxPurchase);
    event SaleExecuted(address indexed token, address indexed buyer, uint256 amount, uint256 price);
    event AuctionCreated(address indexed token, uint256 startingPrice, uint256 tokenAmount, uint256 duration);
    event BidPlaced(address indexed token, address indexed bidder, uint256 amount);
    event AuctionEnded(address indexed token, address indexed winner, uint256 amount);
    event TokensClaimed(address indexed token, address indexed claimer, uint256 amount);

    // Create a direct sale
    function createSale(
        address token,
        uint256 price,
        uint256 minPurchase,
        uint256 maxPurchase
    ) external onlyOwner {
        require(price > 0, "Price must be greater than 0");
        require(maxPurchase >= minPurchase, "Max purchase must be >= min purchase");

        sales[token] = SaleInfo({
            price: price,
            minPurchase: minPurchase,
            maxPurchase: maxPurchase,
            isActive: true
        });

        emit SaleCreated(token, price, minPurchase, maxPurchase);
    }

    // Purchase tokens from direct sale
    function purchaseTokens(address token, uint256 amount) external payable nonReentrant {
        SaleInfo storage sale = sales[token];
        require(sale.isActive, "Sale not active");
        require(amount >= sale.minPurchase, "Amount below minimum");
        require(amount <= sale.maxPurchase, "Amount above maximum");
        require(msg.value == amount * sale.price, "Incorrect payment amount");

        IERC20(token).transfer(msg.sender, amount);
        emit SaleExecuted(token, msg.sender, amount, sale.price);
    }

    // Create an auction
    function createAuction(
        address token,
        uint256 startingPrice,
        uint256 tokenAmount,
        uint256 duration,
        uint256 minIncrement
    ) external onlyOwner {
        require(startingPrice > 0, "Starting price must be greater than 0");
        require(tokenAmount > 0, "Token amount must be greater than 0");
        require(duration > 0, "Duration must be greater than 0");

        auctions[token] = AuctionInfo({
            startingPrice: startingPrice,
            minIncrement: minIncrement,
            duration: duration,
            endTime: block.timestamp + duration,
            highestBidder: address(0),
            highestBid: 0,
            tokenAmount: tokenAmount,
            isActive: true,
            claimed: false
        });

        emit AuctionCreated(token, startingPrice, tokenAmount, duration);
    }

    // Place a bid in an auction
    function placeBid(address token) external payable nonReentrant {
        AuctionInfo storage auction = auctions[token];
        require(auction.isActive, "Auction not active");
        require(block.timestamp < auction.endTime, "Auction ended");
        require(msg.value >= auction.startingPrice, "Bid too low");

        if (auction.highestBidder != address(0)) {
            require(msg.value >= auction.highestBid + auction.minIncrement, "Bid increment too low");
            // Return tokens to previous highest bidder
            pendingReturns[token][auction.highestBidder] += auction.highestBid;
        }

        auction.highestBidder = msg.sender;
        auction.highestBid = msg.value;

        emit BidPlaced(token, msg.sender, msg.value);
    }

    // End auction
    function endAuction(address token) external nonReentrant {
        AuctionInfo storage auction = auctions[token];
        require(auction.isActive, "Auction not active");
        require(block.timestamp >= auction.endTime, "Auction still active");

        auction.isActive = false;

        if (auction.highestBidder != address(0)) {
            IERC20(token).transfer(auction.highestBidder, auction.tokenAmount);
            emit AuctionEnded(token, auction.highestBidder, auction.highestBid);
        }
    }

    // Withdraw a previous bid that was outbid
    function withdrawBid(address token) external nonReentrant {
        uint256 amount = pendingReturns[token][msg.sender];
        require(amount > 0, "No funds to withdraw");

        pendingReturns[token][msg.sender] = 0;
        payable(msg.sender).transfer(amount);
    }

    // Admin functions
    function cancelSale(address token) external onlyOwner {
        sales[token].isActive = false;
    }

    function cancelAuction(address token) external onlyOwner {
        require(auctions[token].isActive, "Auction not active");
        auctions[token].isActive = false;
    }

    function updateSalePrice(address token, uint256 newPrice) external onlyOwner {
        require(sales[token].isActive, "Sale not active");
        sales[token].price = newPrice;
    }

    // Withdraw ETH from contract (from sales and auctions)
    function withdrawETH() external onlyOwner {
        payable(owner()).transfer(address(this).balance);
    }

    // Emergency token withdrawal in case tokens get stuck
    function emergencyWithdraw(address token, uint256 amount) external onlyOwner {
        IERC20(token).transfer(owner(), amount);
    }
}
