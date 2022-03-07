import React, {useEffect, useState} from 'react';
import {ethers} from "ethers";


export default function App() {
    const [input, setInput] = useState('');
    const loadCommissionFee = async () => {
        const marketAbi = document.getElementById('market-abi').getAttribute('data-content');
        const marketAddress = document.getElementById('market-address').getAttribute('data-content');
        const rpcProvider = document.getElementById('provider').getAttribute('data-content');


        const provider = new ethers.providers.JsonRpcProvider(rpcProvider);

        const contract = new ethers.Contract(marketAddress, marketAbi, provider)
        let commissionFee = await contract.getCommissionFee()
        commissionFee = commissionFee.toString();
        setInput(commissionFee)
    }
    useEffect(() => {
        loadCommissionFee()
    }, [])

    const changeCommission = async (e) => {
        e.preventDefault();
        const marketAbi = document.getElementById('market-abi').getAttribute('data-content');
        const marketAddress = document.getElementById('market-address').getAttribute('data-content');

        const provider = new ethers.providers.Web3Provider(window.ethereum, "any");
        await provider.send("eth_requestAccounts", []);
        const signer = provider.getSigner();

        const contract = new ethers.Contract(marketAddress, marketAbi, signer)
        const transaction = await contract.setCommissionFee(input)
        await transaction.wait();
        loadCommissionFee();
    }

    return <>
        <div className="card-body">
            <div className="form-group">
                <label htmlFor="exampleInputEmail1">Commission Fee</label>
                <input type="text" className="form-control" name="commission" value={input} onChange={e => setInput(e.target.value)}/>
            </div>

            <div className="card-footer">
                <button onClick={changeCommission} className="btn btn-primary">Submit</button>
            </div>
        </div>
    </>
}
