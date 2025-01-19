require("dotenv").config();
const { ethers } = require("ethers");
const fs = require("fs");
const path = require("path");

// Load the ABI from the JSON file
const abiPath = path.resolve(__dirname, '../resources/artifacts/contracts/NFTContract.sol/NFTContract.json');
const contractABI = JSON.parse(fs.readFileSync(abiPath)).abi;
const contractAddress = process.env.NFT_CONTRACT_ADDRESS;

// Validate and fetch command-line arguments
const [galleryAddress, metadataUri] = process.argv.slice(2);

if (!galleryAddress || !metadataUri) {
    console.error("Error: galleryAddress and metadataUri are required parameters.");
    process.exit(1);
}

// Connect to Ethereum provider
function getProvider() {
    return new ethers.providers.JsonRpcProvider("https://eth-sepolia.g.alchemy.com/v2/NuZ9eDOiXbZfOKfAXbZlV1j0edIiV50b");
}

// Get wallet connected to the provider
function getWallet(provider) {
    return new ethers.Wallet("a3846e3abd1f32ee9daf97fff417532ee7fe2b814c96418f06fa2c66dcd0857b", provider);
}

// Get NFT contract instance
function getContract(wallet) {
    return new ethers.Contract("0x5754217e78eAE5FF76C4411899D2c7e48a7D322A", contractABI, wallet);
}

// Mint and transfer NFT to the gallery, return the tokenId
async function mintAndTransferNFT(contract, galleryAddress, metadataUri) {
    try {
        // Estimate gas dynamically
        const gasLimit = await contract.estimateGas.mintAndTransferToGallery(galleryAddress, metadataUri);

        const tx = await contract.mintAndTransferToGallery(galleryAddress, metadataUri, {
            gasLimit: gasLimit
        });

        const receipt = await tx.wait();
        // Assuming the contract returns the tokenId in the transaction receipt logs or event
        const tokenId = receipt.events[0].args.tokenId.toString();

        return tokenId;
    } catch (error) {
        throw new Error(`Failed to mint and transfer NFT: ${error.message}`);
    }
}

async function main() {
    const provider = getProvider();
    const wallet = getWallet(provider);
    const contract = getContract(wallet);

    const tokenId = await mintAndTransferNFT(contract, galleryAddress, metadataUri);

    // Output the tokenId to be captured by the controller
    console.log(tokenId);
    return tokenId;
}

main().catch(error => {
    console.error(`Error: ${error.stack}`);
    process.exit(1);
});
