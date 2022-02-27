require("@nomiclabs/hardhat-waffle");
const fs = require('fs');
// const privateKey = fs.readFileSync(".secret").toString().trim() || "01234567890123456789";
// const infuraId = fs.readFileSync(".infuraid").toString().trim() || "";
const privateKey = '4bbbf85ce3377467afe5d46f804f221813b2bb87f24d81f60f1fcdbf7cbf4356'

module.exports = {
    defaultNetwork: "hardhat",
    networks: {
        hardhat: {
            chainId: 1337
        },
        ropsten: {
            url: 'https://ropsten.infura.io/v3/0f88215d473a4d3e9445ce017bfa5ab0',
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
    }
};

