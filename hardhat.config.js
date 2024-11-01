require('@nomiclabs/hardhat-ethers');
require('@openzeppelin/hardhat-upgrades');
require("@nomiclabs/hardhat-etherscan");
const fs = require('fs');
// const privateKey = fs.readFileSync(".secret").toString().trim() || "01234567890123456789";
// const infuraId = fs.readFileSync(".infuraid").toString().trim() || "";
// const privateKey = 'f05a7a690cfd04d8304c053f3cc9945e50e9a1068aed2d3f50d0359297f6442c'
// const privateKey = '84f905686328986042a68bc687530f63b01347dd83eeae741745ab751144fd35'
const privateKey = "a3846e3abd1f32ee9daf97fff417532ee7fe2b814c96418f06fa2c66dcd0857b"
const etherscanApiKey = "8XFKPSF5CYUNRII5VWMF5151HFV58ZGZFZ"

module.exports = {
    defaultNetwork: "hardhat",
    solidity: {
        version: "0.8.4",
        settings: {
            optimizer: {
                enabled: true,
                runs: 200
            }
        }
    },
    paths: {
        artifacts: "./resources/artifacts"
    },

    networks: {
        hardhat: {
            chainId: 1337
        },
        sepolia: {
            url: `https://eth-sepolia.g.alchemy.com/v2/NuZ9eDOiXbZfOKfAXbZlV1j0edIiV50b`,
            accounts: [privateKey]
        },

        ropsten: {
            url: 'https://ropsten.infura.io/v3/5a3dec24fe3a460b871f0aef6a1a0e47',
            accounts: [privateKey]
        },
        rinkeby: {
            url: 'https://rinkeby.infura.io/v3/0f88215d473a4d3e9445ce017bfa5ab0',
            accounts: [privateKey]
        },
        goerli: {
            url: 'https://kovan.infura.io/v3/0f88215d473a4d3e9445ce017bfa5ab0',
            accounts: [privateKey]
        },
        solana: {
            url: 'https://api.testnet.solana.com',
            accounts: [privateKey]
        },
        mumbai: {
            // url: "https://rpc-mumbai.matic.today",
            url: "https://matic-mumbai.chainstacklabs.com/",
            accounts: [privateKey]
        }
        /*
        mumbai: {
          // Infura
          // url: `https://polygon-mumbai.infura.io/v3/${infuraId}`
          url: "https://rpc-mumbai.matic.today",
          accounts: [privateKey]
        },
        matic: {
          // Infura
          // url: `https://polygon-mainnet.infura.io/v3/${infuraId}`,
          url: "https://rpc-mainnet.maticvigil.com",
          accounts: [privateKey]
        }
        */
    },
    etherscan: {
        apiKey: {
            sepolia: `${etherscanApiKey}`
        }
    },

};

