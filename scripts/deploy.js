const {ethers, upgrades, network} = require("hardhat");
const fs = require('fs');

async function main() {
    const NFTMarket = await ethers.getContractFactory("Market");
    const market = await upgrades.deployProxy(NFTMarket, undefined, {initializer: 'initialize'})
    await market.deployed();
    console.log("nftMarket deployed to:", market.address);

    const NFT = await ethers.getContractFactory("NFT");
    const nft = await NFT.deploy(market.address);
    await nft.deployed();
    console.log("nft deployed to:", nft.address);

    let config = `
    export const nftMarketAddress = "${market.address}"
    export const nftAddress = "${nft.address}"
  `

    let data = JSON.stringify(config)
    fs.writeFileSync(`${network.name}Config.js`, JSON.parse(data))

}

main()
    .then(() => process.exit(0))
    .catch(error => {
        console.error(error);
        process.exit(1);
    });
