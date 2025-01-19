const express = require('express');
const path = require('path');

const app = express();
const port = 3000;

app.use(express.json());

const createSaleRoute = require(path.resolve(__dirname, './routes/sales/create-sale'));
const cancelSaleRoute = require(path.resolve(__dirname,'./routes/sales/cancel-sale'));
const createAuctionRoute = require(path.resolve(__dirname,'./routes/sales/create-auction'));
const endAuctionRoute = require(path.resolve(__dirname,'./routes/sales/end-auction'));
const cancelAuctionRoute = require(path.resolve(__dirname,'./routes/sales/cancel-auction'));
const placeBidRoute = require(path.resolve(__dirname,'./routes/sales/place-bid'));
const withdrawBidRoute = require(path.resolve(__dirname,'./routes/sales/withdraw-bid'));
const purchaseTokensRoute = require(path.resolve(__dirname,'./routes/sales/purchase-tokens'));



//Sales Routes
app.use('/create-sale',createSaleRoute);
app.use('/cancel-sale',cancelSaleRoute);
app.use('/create-auction',createAuctionRoute);
app.use('/end-auction',endAuctionRoute);
app.use('/cancel-auction',cancelAuctionRoute);
app.use('/withdraw-bid',withdrawBidRoute);
app.use('/place-bid',placeBidRoute);
app.use('/purchase-tokens',purchaseTokensRoute);


app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});
