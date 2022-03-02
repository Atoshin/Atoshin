import React, {useEffect, useState} from 'react';
import {ethers} from "ethers";
import axios from 'axios';
import {create as ipfsClient} from 'ipfs-http-client';
import NFT from '../../../artifacts/contracts/NFT.sol/NFT.json';

let client;
export default function App() {
    const [contractData, setContractData] = useState({
        asset: {},
        contracts: []
    })


    useEffect(() => {
        const getContractData = async () => {
            const assetId = document.getElementById('mint-button').getAttribute("data-assetId")
            const response = await axios.get(`/api/v1/asset/${assetId}/contracts`)
            setContractData(response.data)
            const auth = 'Basic ' + Buffer.from(response.data.keys.projectId + ":" + response.data.keys.projectSecret).toString('base64')
            client = ipfsClient({
                host: 'ipfs.infura.io',
                port: 5001,
                protocol: 'https',
                headers: {
                    authorization: auth
                }
            })
        }
        getContractData()
    }, [])

    const mint = async (e) => {
        e.preventDefault();
        const contracts = contractData.contracts
        const asset = contractData.asset
        const addresses = contractData.addresses
        const urls = []
        try {
            for (let i = 0; i < contracts.length; i++) {
                if (!!contracts[i].hash) {
                    urls.push(`https://ipfs.infura.io/ipfs/${contracts[i].hash}`)
                } else {
                    const data = JSON.stringify({
                        name: asset.title,
                        description: asset.bio.replace(/<\/?[^>]+(>|$)/g, ""),
                        image: `https://ipfs.infura.io/ipfs/${contracts[i].media.ipfsHash}`,
                        assetImage: `https://ipfs.infura.io/ipfs/${asset.medias[0].ipfsHash}`
                    })
                    const added = await client.add(data)
                    urls.push(`https://ipfs.infura.io/ipfs/${added.path}`)
                    await axios.post(`/api/v1/contract/${contracts[i].id}/ipfs-hash`, {
                        'ipfs-hash': added.path
                    })
                }
            }
            createSale(urls, addresses, asset)
        } catch (e) {
            console.error(e)
        }
    }

    const createSale = async (urls, addresses, asset) => {
        if (window.ethereum) {
            if (urls.length) {
                const provider = new ethers.providers.Web3Provider(window.ethereum, "any");
                await provider.send("eth_requestAccounts", []);
                const signer = provider.getSigner();

                let contract = new ethers.Contract(addresses.NFT, NFT.abi, signer)
                let transaction = await contract.createTokens(urls)
                let tx = await transaction.wait()
                const txnHash = tx.transactionHash
                let event = tx.events[0]
                let value = await event.args[2]
                const address = await signer.getAddress();

                await axios.post(`/api/v1/asset/${asset.id}/mint-record`, {
                    txnHash,
                    previousTokenId: value.toNumber(),
                    mintedContractsLength: urls.length,
                    signerWalletAddress: address
                })
                window.location.reload()
            }
        } else {
            window.open('https://metamask.io/download', '_blank')
        }
    }

    return <button disabled={contractData.asset.totalFractions !== contractData.contracts.length} onClick={mint}
                   className="btn btn-success mr-2 float-right">
        <i className="fa fa-link mr-2 "/>
        Mint contracts
    </button>
}
