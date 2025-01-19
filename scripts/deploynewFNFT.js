const express = require('express');
const { ethers, hre } = require("hardhat");
const path = require("path");
const fs = require("fs");
require('dotenv').config();

const app = express();
const port = process.env.PORT || 3000;

app.use(express.json()); // Middleware to parse JSON request body

function loadContractArtifact() {
    const provider = new ethers.providers.JsonRpcProvider("https://eth-sepolia.g.alchemy.com/v2/NuZ9eDOiXbZfOKfAXbZlV1j0edIiV50b");
    const wallet = new ethers.Wallet('a3846e3abd1f32ee9daf97fff417532ee7fe2b814c96418f06fa2c66dcd0857b', provider);
    const artifactPath = path.resolve(__dirname, '../resources/artifacts/contracts/NewFractionalizer.sol/FractionalNFT.json');
    const contractArtifact = JSON.parse(fs.readFileSync(artifactPath, 'utf8'));
    return {
        abi: contractArtifact.abi,
        bytecode: contractArtifact.bytecode,
        wallet
    };
}

const { abi, bytecode,wallet } = loadContractArtifact();
// Define your deployment endpoint
app.post('/deploy', async (req, res) => {
    try {

        // Get the contract factory for FractionalNFT
        const FractionalNFT = new ethers.ContractFactory(abi, bytecode, wallet);

        // Define constructor parameters
        const name = req.body.name || "Fractional NFT";
        const symbol = req.body.symbol || "fNFT";
          // Replace with actual sales contract address

        // Deploy the contract
        console.log("Deploying FractionalNFT...");
        const fractionalNFT = await FractionalNFT.deploy(name, symbol,{gasLimit :2000000});

        // Wait for the contract to be deployed
        const contract = await fractionalNFT.deployed();

        console.log("FractionalNFT deployed to:", fractionalNFT.address);

        // Send the deployed contract address in the response
        res.json({
            transactionHash: fractionalNFT.deployTransaction.transactionHash,
            fractionTokenAddress: contract.address
        });

    } catch (error) {
        console.error("Deployment error:", error);
        res.status(500).send({ error: "Failed to deploy contract" });
    }
});
app.post('/transfer-to-sales', async (req, res) => {
    console.log(req.body)
    const { amount, contractAddress } = req.body;

    if (!amount || amount <= 0) {
        console.log("Invalid amount provided")
        return res.status(400).set('Content-Type', 'application/json').json({ error: 'Invalid amount provided' });
    }

    if (!contractAddress) {
        console.log("Contract address is required")
        return res.status(400).set('Content-Type', 'application/json').json({ error: 'Contract address is required' });
    }

    try {
        const contract = new ethers.Contract(contractAddress, abi, wallet);

        // Estimate gas for the transaction
        // const gasEstimate = await contract.estimateGas.transferToSalesContract(amount);
        // res.status(200).json(gasEstimate);
        // Call the transferToSalesContract function
        const tx = await contract.transferToSalesContract(amount, { gasLimit: 5000000 });

        // Wait for the transaction to be mined
        const receipt = await tx.wait();

        return res.status(200).set('Content-Type', 'application/json').json({
            message: 'Tokens transferred to sales contract successfully',
            transactionHash: receipt.transactionHash
        });
    } catch (error) {
        console.error('Error in transfer-to-sales:', error);
        return res.status(500).set('Content-Type', 'application/json').json({ error: 'Failed to transfer tokens', details: error.message });
    }
});

app.post('/initialize', async (req, res) => {
    const {
        contractAddress,
        galleryAddress,
        nftAddress,
        tokenId,
        totalSupply,
        galleryShare,
        salesContract
    } = req.body;

    if (!contractAddress) {
        return res.status(400).json({ error: 'Contract address is required' });
    }

    try {
        const contract = new ethers.Contract(contractAddress, abi, wallet);

        // Estimate gas for the initialize transaction
        const gasEstimate = await contract.estimateGas.initialize(
            galleryAddress,
            nftAddress,
            tokenId,
            totalSupply,
            galleryShare,
            salesContract
        );

        // Call the initialize function
        const tx = await contract.initialize(
            galleryAddress,
            nftAddress,
            tokenId,
            totalSupply,
            galleryShare,
            salesContract,
            { gasLimit: gasEstimate }
        );

        // Wait for the transaction to be mined
        const receipt = await tx.wait();

        return res.status(200).json({
            message: 'Contract initialized successfully',
            transactionHash: receipt.transactionHash
        });
    } catch (error) {
        console.error('Error in initialize:', error);
        return res.status(500).json({ error: 'Failed to initialize contract', details: error.message });
    }
});


// Start the server
app.listen(port, () => {
    console.log(`Server running on http://localhost:${port}`);
});
