import React from 'react';
import {ethers} from "ethers";
import axios from 'axios';
import {create as IPFSHttpClient} from 'ipfs-http-client';
import NFT from '../../../artifacts/contracts/NFT.sol/NFT.json';
import Market from '../../../artifacts/contracts/Market.sol/NFTMarket.json';

const client = IPFSHttpClient('https://ipfs.infura.io:5001/api/v0')

export default function App() {

    const mint = async (e) => {
        const assetId = document.getElementById('mint-button').getAttribute("data-assetId")
        const response = await axios.get(`/api/v1/asset/${assetId}/contracts`)
        const contracts = response.data.contracts
        const asset = response.data.asset
        const addresses = response.data.addresses
        const urls = []
        for (let i = 0; i < contracts.length; i++) {
            const data = JSON.stringify({
                name: asset.title,
                description: asset.bio.replace(/<\/?[^>]+(>|$)/g, ""),
                image: `https://ipfs.infura.io/ipfs/${contracts[i].media.hash}`,
                assetImage: `https://ipfs.infura.io/ipfs/${asset.medias[0].ipfs_hash}`
            })
            try {
                const added = await client.add(data)
                urls.push(`https://ipfs.infura.io/ipfs/${added.path}`)
            } catch (e) {
                console.error(e)
            }
        }
        createSale(urls, addresses, asset)
    }

    const createSale = async (urls, addresses, asset) => {
        if (window.ethereum) {
            const provider = new ethers.providers.Web3Provider(window.ethereum, "any");
            await provider.send("eth_requestAccounts", []);
            const signer = provider.getSigner();
            const address = await signer.getAddress();


            let contract = new ethers.Contract(addresses.NFT, NFT.abi, signer)
            let transaction = await contract.createTokens(urls)
            let tx = await transaction.wait()
            let event = tx.events[0]
            let value = event.args[2]
            let tokenId = value.toNumber()

            contract = new ethers.Contract(addresses.Market, Market.abi, signer)

            const price = ethers.utils.parseUnits(formInput.price, 'ether')

        } else {
            window.open('https://metamask.io/download', '_blank')
        }
    }

    return <button onClick={mint} className="btn btn-success mr-2 float-right">
        <i className="fa fa-link mr-2 "/>
        Mint contracts
    </button>
}
