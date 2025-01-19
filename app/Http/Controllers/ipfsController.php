<?php

namespace App\Http\Controllers;

use App\Jobs\MintNFTJob;
use App\Models\Asset;
use App\Models\MetaData;
use App\Service\IPFS\IPFSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Web3\Web3;
use Web3\Contract;
use Web3\Utils;
use function PHPUnit\Framework\throwException;

class ipfsController extends Controller
{
    protected $ipfsService;
    protected $web3;
    protected $contract;
    protected $walletAddress;
    protected $privateKey;

    public function __construct(IPFSService $ipfsService)
    {
        $this->ipfsService = $ipfsService;
        $sepoliaUrl = 'https://eth-sepolia.g.alchemy.com/v2/NuZ9eDOiXbZfOKfAXbZlV1j0edIiV50b';
        $this->web3 = new Web3($sepoliaUrl);// Connect to your blockchain node
        $this->web3->eth->defaultAccount = env('WALLET_ADDRESS');
        $abi = json_decode(file_get_contents(resource_path('artifacts/contracts/NFTContract.sol/NFTContract.json')), true); // Load ABI

        $this->contract = new Contract($this->web3->provider, $abi);
        $this->contract->at(config('app.NFT_CONTRACT_ADDRESS')); // Replace with your contract's address


        // Load wallet address and private key from .env
        $this->walletAddress = env('WALLET_ADDRESS');
        $this->privateKey = env('PRIVATE_KEY');
    }



    public function mint(Request $request,$asset_id)
    {
//        $request->validate([
//            'asset_id' => 'required|exists:assets,id',
//
//        ]);
        $asset = Asset::query()->with(['medias','gallery'])->where("id", $request->asset_id)->first();

//        if($asset->metadata !== null){
//            throw new \Exception("Asset already exists");
//        }

        // Upload image to IPFS
        $imageHash = $this->ipfsService->add(file_get_contents($asset->medias()->where('main',true)->first()->path));
        $imageUri = "ipfs://".$imageHash;

        // Create metadata
        $metadata = [
            'name' => $asset->name,
            'description' => $asset->description,
            'image' => $imageUri,
        ];

        // Upload metadata to IPFS
        $metadataHash = $this->ipfsService->add(json_encode($metadata));
        $metadataUri = "ipfs://{$metadataHash}";

        // Mint NFT on Sepolia testnet

        $galleryAddress = $asset->gallery->wallet->wallet_address;
//        dd($galleryAddress);


        try {
            Session::flash('status', 'Your NFT is being minted. Please wait...');
            $job = new MintNFTJob($galleryAddress, $metadataUri);
            $tokenId = $job->handle(); // Execute the job and get the tokenId
        } catch (\Exception $e) {
            return redirect()->back()->with(['success'=>'false','error'=>$e->getMessage()]);
        }
        // Update the asset record
        MetaData::query()->create([
            'token_id' => (int) trim($tokenId),
            'metadata_uri' => $metadataUri,
            'asset_id'=>$asset_id
        ]);
//        $asset->update([
//            'token_id' => $tokenId,
//            'metadata_uri' => $metadataUri,
//            'is_minted' => true,
//        ]);

        return redirect()->back()->with(['success'=>'true','title'=>'NFT minted successfully!']);
    }

    private function mintNFTOnBlockchain($galleryAddress, $metadataUri)
    {
        dd($this->web3->getProvider());
      $data = $this->contract->getData('mintAndTransferToGallery', $galleryAddress, $metadataUri);
        // Estimate gas
        $gasLimit = '300000';  // Adjust gas limit as necessary
        $gasPrice = Utils::toWei('20', 'gwei');  // Set appropriate gas price (in Wei)

        // Get the nonce for the transaction
        $this->web3->eth->getTransactionCount($this->walletAddress, 'latest', function ($err, $nonce) use ($data, $gasLimit, $gasPrice, $galleryAddress, &$tokenId) {
            if ($err !== null) {
                throw new \Exception('Failed to get transaction count: ' . $err->getMessage());
            }

            // Build the transaction
            $transaction = [
                'from' => $this->walletAddress,
                'to' => $this->contract->address,
                'nonce' => '0x' . dechex($nonce),
                'gas' => $gasLimit,
                'gasPrice' => $gasPrice,
                'data' => $data
            ];

            // Sign the transaction with the private key
            $this->web3->eth->signTransaction($transaction, $this->privateKey, function ($err, $signedTx) use (&$tokenId) {
                if ($err !== null) {
                    throw new \Exception('Failed to sign transaction: ' . $err->getMessage());
                }

                // Send the signed transaction
                $this->web3->eth->sendSignedTransaction($signedTx, function ($err, $txHash) use (&$tokenId) {
                    if ($err !== null) {
                        throw new \Exception('Transaction failed: ' . $err->getMessage());
                    }

                    // Fetch the transaction receipt
                    $this->web3->eth->getTransactionReceipt($txHash, function ($err, $receipt) use (&$tokenId) {
                        if ($err !== null) {
                            throw new \Exception('Failed to fetch receipt: ' . $err->getMessage());
                        }

                        // Check logs for the TokenMinted event
                        foreach ($receipt->logs as $log) {
                            // Assuming the TokenMinted event is at index 0, check the event signature
                            if ($log->topics[0] === $this->contract->getEventSignature('TokenMinted')) {
                                // Extract tokenId from the event logs
                                $tokenId = hexdec($log->topics[1]);  // Convert hex tokenId to decimal
                                break;
                            }
                        }
                    });
                });
            });
        });

        return $tokenId;
    }
}
