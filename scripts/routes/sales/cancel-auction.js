const express = require('express');
const router = express.Router();
const { ethers } = require('ethers');
const path = require('path');
const fs = require('fs');

// Load contract details
function loadContractArtifact() {
    const artifactPath = path.resolve(__dirname, '../../../resources/artifacts/contracts/NFTFractionsSale.sol/FractionSales.json');
    const contractArtifact = JSON.parse(fs.readFileSync(artifactPath, 'utf8'));
    // Initialize provider and wallet
    const provider = new ethers.providers.JsonRpcProvider("https://eth-sepolia.g.alchemy.com/v2/NuZ9eDOiXbZfOKfAXbZlV1j0edIiV50b");
    const wallet = new ethers.Wallet('a3846e3abd1f32ee9daf97fff417532ee7fe2b814c96418f06fa2c66dcd0857b', provider);
    return {
        abi: contractArtifact.abi,
        bytecode: contractArtifact.bytecode,
        address: "0x24634772cB7cBD56Ea8622a17196d2Dadb02897d",// Replace with your contract address
        provider,
        wallet
    };
}



// Route to create a sale
router.post('/', async (req, res) => {
    const { token } = req.body;

    if (!token) {
        return res.status(400).json({ error: 'Missing required parameters' });
    }

    try {
        const { abi, address,provider,wallet } = loadContractArtifact();
        const contract = new ethers.Contract(address, abi, wallet);

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

module.exports = router;
