import React, {useEffect, useState} from 'react';
import {ethers} from "ethers";
import axios from 'axios';
import {create as ipfsClient} from 'ipfs-http-client';
import NFT from '../../../../artifacts/contracts/NFT.sol/NFT.json';

let client;
export default function App() {

    const mint = async (e) => {
        e.preventDefault();
        const parentNode = e.target.parentNode
        const contractId = parentNode.getAttribute('data-contractid')
        const response = await axios.get(`/api/v1/contract/${contractId}/data`)

        const auth = 'Basic ' + Buffer.from(response.data.keys.projectId + ":" + response.data.keys.projectSecret).toString('base64')
        client = ipfsClient({
            host: 'ipfs.infura.io',
            port: 5001,
            protocol: 'https',
            headers: {
                authorization: auth
            }
        })
        const contract = response.data.contract;
        const asset = response.data.asset;
        const addresses = response.data.addresses;

        let url;
        try {
            if (!!contract.hash) {
                url = `${contract.hash}`
            } else {
                const data = JSON.stringify({
                    name: asset.title,
                    description: asset.bio.replace(/<\/?[^>]+(>|$)/g, ""),
                    image: `https://ipfs.infura.io/ipfs/${contract.media.ipfsHash}`,
                    assetImage: `https://ipfs.infura.io/ipfs/${asset.medias[0].ipfsHash}`
                })
                const added = await client.add(data)
                url = `${added.path}`
                await axios.post(`/api/v1/contract/${contract.id}/ipfs-hash`, {
                    'ipfs-hash': added.path
                })
            }
            createSale(url, addresses, contract)
        } catch (e) {
            console.error(e)
        }
    }

    const createSale = async (url, addresses, ipfsContract) => {
        if (window.ethereum) {
            if (url) {
                url = `https://ipfs.infura.io/ipfs/${url}`
                const provider = new ethers.providers.Web3Provider(window.ethereum, "any");
                await provider.send("eth_requestAccounts", []);
                const signer = provider.getSigner();

                let contract = new ethers.Contract(addresses.NFT, NFT.abi, signer)
                let transaction = await contract.createToken(url)
                let tx = await transaction.wait()
                let event = tx.events[0]
                let value = await event.args[2]
                const address = await signer.getAddress();
                const txnHash = tx.transactionHash
                await axios.post(`/api/v1/contract/${ipfsContract.id}/mint-record`, {
                    txnHash,
                    tokenId: value.toNumber(),
                    signerWalletAddress: address
                })
            }
        } else {
            window.open('https://metamask.io/download', '_blank')
        }
    }

    return <button onClick={mint}
                   className="btn btn-success mr-2 float-right">
        <i className="fa fa-link mr-2 "/>
        Mint
    </button>
}
