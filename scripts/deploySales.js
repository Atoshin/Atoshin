// deploy.js
const { ethers } = require("hardhat");

async function main() {

    // Deploy FractionSales
    console.log("Deploying FractionSales...");
    const FractionSales = await ethers.getContractFactory("FractionSales");
    const sales = await FractionSales.deploy();
    await sales.deployed();
    console.log("FractionSales deployed to:", sales.address);

    // Verify contracts on Etherscan
    console.log("Waiting for blocks to be mined...");

    await sales.deployTransaction.wait(5);

    console.log("Verifying contracts...");


    await hre.run("verify:verify", {
        address: sales.address,
        constructorArguments: [],
    });
}

main()
    .then(() => process.exit(0))
    .catch((error) => {
        console.error(error);
        process.exit(1);
    });
