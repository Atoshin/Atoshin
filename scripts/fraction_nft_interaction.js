// scripts/fractionalize-nft.js
const hre = require("hardhat");
require('dotenv').config()

async function getContractInstance(contractAddress) {
    const Fractionalizer = await hre.ethers.getContractFactory("Fractionalizer");
    return Fractionalizer.attach(contractAddress);
}

async function fractionalizeNFT(fractionalizer, nftId, tokenName, totalFractions, ownerAddress, ownerShare) {
    const tx = await fractionalizer.fractionalizeNFT(nftId, tokenName, totalFractions, ownerAddress, ownerShare);
    await tx.wait(); // Wait for the transaction to be confirmed
    console.log("NFT fractionalized!");
}

async function getTokenAddress(fractionalizer, nftId) {
    const tokenAddress = await fractionalizer.fractionalTokenAddress(nftId);
    console.log("ERC-20 Token Address:", tokenAddress);
    return tokenAddress;
}

async function getRemainingForSale(fractionalizer, nftId) {
    const remainingForSale = await fractionalizer.getRemainingForSale(nftId);
    console.log("Remaining Tokens for Sale:", remainingForSale.toString());
    return remainingForSale;
}

async function getOwnerFraction(fractionalizer, nftId) {
    const ownerFraction = await fractionalizer.getOwnerFraction(nftId);
    console.log("Owner's Fraction:", ownerFraction.toString());
    return ownerFraction;
}

async function main(fractionalizerAddress, nftId, tokenName, totalFractions, ownerAddress, ownerShare) {
    // Get the contract instance
    const fractionalizer = await getContractInstance(fractionalizerAddress);

    // Fractionalize the NFT
    const result = await fractionalizeNFT(fractionalizer, nftId, tokenName, totalFractions, ownerAddress, ownerShare);
    console.log(result)
    // Get information and return as an array
    // const tokenAddress = await getTokenAddress(fractionalizer, nftId);
    // const remainingForSale = await getRemainingForSale(fractionalizer, nftId);
    // const ownerFraction = await getOwnerFraction(fractionalizer, nftId);
    //
    // return [tokenAddress, remainingForSale.toString(), ownerFraction.toString()];
}

// Get command-line arguments
const args = process.argv.slice(2);
if (args.length !== 6) {
    console.error("Usage: node scripts/fractionalize-nft.js <fractionalizerAddress> <nftId> <tokenName> <totalFractions> <ownerAddress> <ownerShare>");
    process.exit(1);
}

const [fractionalizerAddress, nftIdStr, tokenName, totalFractionsStr, ownerAddress, ownerShareStr] = args;
const nftId = parseInt(nftIdStr);
const totalFractions = parseInt(totalFractionsStr);
const ownerShare = parseInt(ownerShareStr);

// Execute the fractionalization script with arguments
main(fractionalizerAddress, nftId, tokenName, totalFractions, ownerAddress, ownerShare)
    .then((results) => {
        console.log("Results:", results);
        process.exit(0);
    })
    .catch((error) => {
        console.error(error);
        process.exit(1);
    });


