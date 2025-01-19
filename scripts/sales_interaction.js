// Import required packages
const express = require('express');
const { ethers } = require('ethers');
const path = require('path');
const fs = require('fs');
require('dotenv').config();

// Initialize Express app
const app = express();
const port =  4000;

// Middleware to parse JSON
app.use(express.json());

// Function to load contract artifact
function loadContractArtifact() {
    const artifactPath = path.resolve(__dirname, '../resources/artifacts/contracts/FractionSales.sol/FractionSales.json');
    const contractArtifact = JSON.parse(fs.readFileSync(artifactPath, 'utf8'));
    return {
        abi: contractArtifact.abi
    };
}

// Load ABI from contract artifact
const { abi } = loadContractArtifact();

// Helper function to initialize contract
function getContractInstance(contractAddress) {
    const provider = new ethers.providers.JsonRpcProvider(process.env.RPC_URL);
    const wallet = new ethers.Wallet(process.env.PRIVATE_KEY, provider);
    return new ethers.Contract(contractAddress, abi, wallet);
}

// Endpoint to create a sale
app.post('/create-sale', async (req, res) => {
    const { token, price, minPurchase, maxPurchase, contractAddress } = req.body;

    if (!token || !price || !minPurchase || !maxPurchase || !contractAddress) {
        return res.status(400).json({ error: 'Missing required parameters' });
    }

    try {
        const contract = getContractInstance(contractAddress);

        const gasEstimate = await contract.estimateGas.createSale(token, price, minPurchase, maxPurchase);

        const tx = await contract.createSale(token, price, minPurchase, maxPurchase, { gasLimit: gasEstimate });

        const receipt = await tx.wait();

        return res.status(200).json({
            message: 'Sale created successfully',
            transactionHash: receipt.transactionHash
        });
    } catch (error) {
        console.error('Error in create-sale:', error);
        return res.status(500).json({ error: 'Failed to create sale', details: error.message });
    }
});

// Endpoint to purchase tokens
app.post('/purchase-tokens', async (req, res) => {
    const { token, amount, contractAddress } = req.body;

    if (!token || !amount || !contractAddress) {
        return res.status(400).json({ error: 'Missing required parameters' });
    }

    try {
        const contract = getContractInstance(contractAddress);

        const saleInfo = await contract.sales(token);
        const totalCost = ethers.BigNumber.from(saleInfo.price).mul(amount);

        const tx = await contract.purchaseTokens(token, amount, { value: totalCost });

        const receipt = await tx.wait();

        return res.status(200).json({
            message: 'Tokens purchased successfully',
            transactionHash: receipt.transactionHash
        });
    } catch (error) {
        console.error('Error in purchase-tokens:', error);
        return res.status(500).json({ error: 'Failed to purchase tokens', details: error.message });
    }
});

// Endpoint to create an auction
app.post('/create-auction', async (req, res) => {
    const { token, startingPrice, tokenAmount, duration, minIncrement, contractAddress } = req.body;

    if (!token || !startingPrice || !tokenAmount || !duration || !minIncrement || !contractAddress) {
        return res.status(400).json({ error: 'Missing required parameters' });
    }

    try {
        const contract = getContractInstance(contractAddress);

        const gasEstimate = await contract.estimateGas.createAuction(token, startingPrice, tokenAmount, duration, minIncrement);

        const tx = await contract.createAuction(token, startingPrice, tokenAmount, duration, minIncrement, { gasLimit: gasEstimate });

        const receipt = await tx.wait();

        return res.status(200).json({
            message: 'Auction created successfully',
            transactionHash: receipt.transactionHash
        });
    } catch (error) {
        console.error('Error in create-auction:', error);
        return res.status(500).json({ error: 'Failed to create auction', details: error.message });
    }
});

// Endpoint to place a bid
app.post('/place-bid', async (req, res) => {
    const { token, bidAmount, contractAddress } = req.body;

    if (!token || !bidAmount || !contractAddress) {
        return res.status(400).json({ error: 'Missing required parameters' });
    }

    try {
        const contract = getContractInstance(contractAddress);

        const tx = await contract.placeBid(token, { value: bidAmount });

        const receipt = await tx.wait();

        return res.status(200).json({
            message: 'Bid placed successfully',
            transactionHash: receipt.transactionHash
        });
    } catch (error) {
        console.error('Error in place-bid:', error);
        return res.status(500).json({ error: 'Failed to place bid', details: error.message });
    }
});

// Endpoint to end an auction
app.post('/end-auction', async (req, res) => {
    const { token, contractAddress } = req.body;

    if (!token || !contractAddress) {
        return res.status(400).json({ error: 'Missing required parameters' });
    }

    try {
        const contract = getContractInstance(contractAddress);

        const tx = await contract.endAuction(token);

        const receipt = await tx.wait();

        return res.status(200).json({
            message: 'Auction ended successfully',
            transactionHash: receipt.transactionHash
        });
    } catch (error) {
        console.error('Error in end-auction:', error);
        return res.status(500).json({ error: 'Failed to end auction', details: error.message });
    }
});

// Endpoint to withdraw a bid
app.post('/withdraw-bid', async (req, res) => {
    const { token, contractAddress } = req.body;

    if (!token || !contractAddress) {
        return res.status(400).json({ error: 'Missing required parameters' });
    }

    try {
        const contract = getContractInstance(contractAddress);

        const tx = await contract.withdrawBid(token);

        const receipt = await tx.wait();

        return res.status(200).json({
            message: 'Bid withdrawn successfully',
            transactionHash: receipt.transactionHash
        });
    } catch (error) {
        console.error('Error in withdraw-bid:', error);
        return res.status(500).json({ error: 'Failed to withdraw bid', details: error.message });
    }
});

// Endpoint to cancel a sale
app.post('/cancel-sale', async (req, res) => {
    const { token, contractAddress } = req.body;

    if (!token || !contractAddress) {
        return res.status(400).json({ error: 'Missing required parameters' });
    }

    try {
        const contract = getContractInstance(contractAddress);

        const tx = await contract.cancelSale(token);

        const receipt = await tx.wait();

        return res.status(200).json({
            message: 'Sale cancelled successfully',
            transactionHash: receipt.transactionHash
        });
    } catch (error) {
        console.error('Error in cancel-sale:', error);
        return res.status(500).json({ error: 'Failed to cancel sale', details: error.message });
    }
});

// Endpoint to cancel an auction
app.post('/cancel-auction', async (req, res) => {
    const { token, contractAddress } = req.body;

    if (!token || !contractAddress) {
        return res.status(400).json({ error: 'Missing required parameters' });
    }

    try {
        const contract = getContractInstance(contractAddress);

        const tx = await contract.cancelAuction(token);

        const receipt = await tx.wait();

        return res.status(200).json({
            message: 'Auction cancelled successfully',
            transactionHash: receipt.transactionHash
        });
    } catch (error) {
        console.error('Error in cancel-auction:', error);
        return res.status(500).json({ error: 'Failed to cancel auction', details: error.message });
    }
});
