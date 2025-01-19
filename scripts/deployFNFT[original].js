const { ethers } = require('ethers');
const fs = require('fs');
const path = require('path');
require('dotenv').config();
const yargs = require('yargs/yargs');
const { hideBin } = require('yargs/helpers');

// Function to load contract artifacts
function loadContractArtifact() {
    const artifactPath = path.resolve(__dirname, '../resources/artifacts/contracts/Fractionalizer.sol/NFTFractionalizer.json')
    const contractArtifact = JSON.parse(fs.readFileSync(artifactPath, 'utf8'));
    return {
        abi: contractArtifact.abi,
        bytecode: contractArtifact.bytecode
    };
}

async function deployNFTFractionalizer(galleryAddress) {
    try {
        const provider = new ethers.providers.JsonRpcProvider(process.env.ALCHEMY_API_URL);
        const wallet = new ethers.Wallet(process.env.PRIVATE_KEY, provider);
        const deployerAddress = await wallet.getAddress();

        // console.log('Deploying from address:', deployerAddress);
        // console.log('Gallery address:', galleryAddress);

        const balance = await provider.getBalance(deployerAddress);
        // console.log('Deployer balance:', ethers.utils.formatEther(balance), 'ETH');

        const { abi, bytecode } = loadContractArtifact();

        const NFTFractionalizer = new ethers.ContractFactory(
            abi,
            bytecode,
            wallet
        );

        // console.log('Deploying NFTFractionalizer contract...');

        const deploymentTx = await NFTFractionalizer.deploy(galleryAddress, {
            gasLimit: 5000000
        });

        const contract = await deploymentTx.deployed();

        // console.log('Contract deployed successfully!');
        // console.log('Contract address:', contract.address);
        const jsonOutput = JSON.stringify({
            contractAddress: contract.address,
            deploymentTransaction: deploymentTx.deployTransaction.hash,
            contract: contract
        });
        console.log(jsonOutput)

    } catch (error) {
        console.error('Error deploying contract:', error);
        throw error;
    }
}

async function fractionateNFT(
    contractAddress,
    nftAddress,
    tokenId,
    tokenName,
    tokenSymbol,
    totalSupply,
    galleryShare,
    atoshinShare
) {
    try {
        const provider = new ethers.providers.JsonRpcProvider(process.env.ALCHEMY_API_URL);
        const wallet = new ethers.Wallet(process.env.PRIVATE_KEY, provider);

        const { abi } = loadContractArtifact();
        const contract = new ethers.Contract(contractAddress, abi, wallet);
        // Convert string values to BigNumber
        const totalSupplyBN = ethers.utils.parseEther(totalSupply);
        const galleryShareBN = ethers.utils.parseEther(galleryShare);
        const atoshinShareBN = ethers.utils.parseEther(atoshinShare);


        console.log('Fractionalizing NFT with parameters:');
        console.log({
            contractAddress,
            nftAddress,
            tokenId,
            tokenName,
            tokenSymbol,
            totalSupply: totalSupply,
            galleryShare: galleryShare,
            atoshinShare: atoshinShare
        });

        console.log('Amounts in Wei:');
        console.log({
            totalSupplyWei: totalSupplyBN.toString(),
            galleryShareWei: galleryShareBN.toString()
        });

        const tx = await contract.fractionalize(
            nftAddress,
            tokenId,
            tokenName,
            tokenSymbol,
            totalSupplyBN,
            galleryShareBN,
            atoshinShareBN,
            {
                gasLimit: 3000000
            }
        );

        const receipt = await tx.wait();
        console.log('NFT fractionalized successfully!');
        console.log('Transaction hash:', receipt.transactionHash);

        const event = receipt.events.find(e => e.event === 'NFTFractionalized');
        const fractionTokenAddress = event.args.fractionToken;
        const jsonOutput = JSON.stringify({
            receipt: receipt,
            txn_hash: receipt.transactionHash
        });
        // console.log(jsonOutput);
        // process.exit(0)
        console.log('Fraction token address:', fractionTokenAddress);
        return jsonOutput;

    } catch (error) {
        console.log(`Failed to Fraction NFT: ${error.stack}`);
        process.exit(1);
    }
}

// Parse command line arguments
const argv = yargs(hideBin(process.argv))
    .command('deploy', 'Deploy the NFTFractionalizer contract', {
        gallery: {
            description: 'Gallery address',
            alias: 'g',
            type: 'string',
            demandOption: true
        }
    })
    .command('fractionalize', 'Fractionalize an NFT', {
        contract: {
            description: 'NFTFractionalizer contract address',
            alias: 'c',
            type: 'string',
            demandOption: true
        },
        nft: {
            description: 'NFT contract address',
            alias: 'n',
            type: 'string',
            demandOption: true
        },
        tokenId: {
            description: 'NFT token ID',
            alias: 't',
            type: 'number',
            demandOption: true
        },
        name: {
            description: 'Fraction token name',
            alias: 'a',
            type: 'string',
            demandOption: true
        },
        symbol: {
            description: 'Fraction token symbol',
            alias: 's',
            type: 'string',
            demandOption: true
        },
        supply: {
            description: 'Total supply of fraction tokens',
            alias: 'u',
            type: 'string',
            demandOption: true
        },
        gallry_share: {
            description: 'Gallery share of tokens',
            alias: 'h',
            type: 'string',
            demandOption: true
        },
        atoshinShare: {
            description: 'Atoshin share of tokens',
            alias: 'i',
            type: 'string',
            demandOption: true
        }

    })
    .demandCommand(1)
    .help()
    .argv;

async function main() {
    const command = argv._[0];

    if (command === 'deploy') {
        await deployNFTFractionalizer(argv.gallery);
    }
    else if (command === 'fractionalize') {
        await fractionateNFT(
            argv.contract,
            argv.nft,
            argv.tokenId,
            argv.name,
            argv.symbol,
            argv.supply,
            argv.gallry_share,
            argv.atoshinShare
        );
    }
}

main().catch(error => {
    console.error(`Error: ${error.stack}`);
    process.exit(1);
});

module.exports = {
    deployNFTFractionalizer,
    fractionateNFT
};


