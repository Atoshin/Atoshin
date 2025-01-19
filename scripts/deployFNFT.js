const express = require('express');
const { ethers } = require('ethers');
const fs = require('fs');
const path = require('path');
require('dotenv').config();

const app = express();
app.use(express.json());  // To parse JSON requests

// Load contract artifact
function loadContractArtifact() {
    const artifactPath = path.resolve(__dirname, '../resources/artifacts/contracts/Fractionalizer.sol/NFTFractionalizer.json');
    const contractArtifact = JSON.parse(fs.readFileSync(artifactPath, 'utf8'));
    return {
        abi: contractArtifact.abi,
        bytecode: contractArtifact.bytecode
    };
}

// Deploy NFTFractionalizer
async function deployNFTFractionalizer(galleryAddress) {
    const provider = new ethers.providers.JsonRpcProvider("https://eth-sepolia.g.alchemy.com/v2/NuZ9eDOiXbZfOKfAXbZlV1j0edIiV50b");
    const wallet = new ethers.Wallet('a3846e3abd1f32ee9daf97fff417532ee7fe2b814c96418f06fa2c66dcd0857b', provider);
    const { abi, bytecode } = loadContractArtifact();

    const NFTFractionalizer = new ethers.ContractFactory(abi, bytecode, wallet);
    const deploymentTx = await NFTFractionalizer.deploy(galleryAddress, { gasLimit: 2000000 });
    const contract = await deploymentTx.deployed();

    return {
        contractAddress: contract.address,
        deploymentTransaction: deploymentTx.deployTransaction.hash,
        contract:contract
    };
}

// Fractionate NFT
async function fractionateNFT(contractAddress, nftAddress, tokenId, tokenName, tokenSymbol, totalSupply, galleryShare) {
    const provider = new ethers.providers.JsonRpcProvider("https://eth-sepolia.g.alchemy.com/v2/NuZ9eDOiXbZfOKfAXbZlV1j0edIiV50b");
    const wallet = new ethers.Wallet('a3846e3abd1f32ee9daf97fff417532ee7fe2b814c96418f06fa2c66dcd0857b', provider);

    const { abi } = loadContractArtifact();
    const contract = new ethers.Contract(contractAddress, abi, wallet);

    // Convert to BigNumber
    const totalSupplyBN = ethers.utils.parseEther(totalSupply);
    const galleryShareBN = ethers.utils.parseEther(galleryShare);


    const tx = await contract.fractionalize(nftAddress, tokenId, tokenName, tokenSymbol, totalSupplyBN, galleryShareBN, { gasLimit: 3000000 });
    const receipt = await tx.wait();

    const event = receipt.events.find(e => e.event === 'NFTFractionalized');
    const fractionTokenAddress = event.args.fractionToken;

    return {
        transactionHash: receipt.transactionHash,
        fractionTokenAddress: fractionTokenAddress
    };
}

// Define API endpoints

// Deploy endpoint
app.post('/deploy', async (req, res) => {
    const { galleryAddress } = req.body;
    try {
        const result = await deployNFTFractionalizer(galleryAddress);
        res.json(result);
    } catch (error) {
        res.status(500).json({ error: error.stack });
    }
});

// Fractionate endpoint
app.post('/fractionalize', async (req, res) => {
    const { contractAddress, nftAddress, tokenId, tokenName, tokenSymbol, totalSupply, galleryShare } = req.body;
    try {
        const result = await fractionateNFT(contractAddress, nftAddress, tokenId, tokenName, tokenSymbol, totalSupply, galleryShare);
        res.json(result);
    } catch (error) {
        res.status(500).json({ error: error.stack });
    }
});

// Start the Express server
const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
