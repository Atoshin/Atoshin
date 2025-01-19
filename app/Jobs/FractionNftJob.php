<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
class FractionNftJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $nftContractAddress;
    protected $nftId;
    protected $tokenName;
    protected $tokenSymbol;
    protected $totalSupply;
    protected $galleryShare;
    protected $galleryAddress;



    /**
     * Create a new job instance.
     */
    public function __construct($tokenName,$tokenSymbol)
    {
//        $this->nftContractAddress = $nftContractAddress;
//        $this->nftId = $nftId;
            $this->tokenName = $tokenName;
            $this->tokenSymbol = $tokenSymbol;
//        $this->totalSupply =strval($totalSupply);
//        $this->galleryShare = strval($galleryShare);
//        $this->galleryAddress = $galleryAddress;

    }

    /**
     * Execute the job.
     * @throws \Exception
     */
    public function handle()
    {
        $client = new Client();
        $url =config('app.NODE_SERVER_URL').'/deploy';
        try {

            $response = $client->post($url, [
                'json' => [
                    'name'=>$this->tokenName,
                    'symbol'=>$this->tokenSymbol,
                ]
            ]);

            // Decode the JSON response
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {

            return "Error: " . $e->getMessage();
        }
    }


}


//$scriptPath = base_path('scripts'.DIRECTORY_SEPARATOR.'deployFNFT.js');
//
//// Escape each argument to ensure safe execution
//$scriptPath = escapeshellarg($scriptPath);
//$this->fractionContractAddress = escapeshellarg($this->fractionContractAddress);
//$this->nftContractAddress = escapeshellarg($this->nftContractAddress);
//$this->nftId = escapeshellarg($this->nftId);
//$this->tokenName = escapeshellarg($this->tokenName);
//$this->tokenSymbol = escapeshellarg($this->tokenSymbol);
//$this->totalSupply = escapeshellarg($this->totalSupply);
//$this->galleryShare = escapeshellarg($this->galleryShare);
//$this->atoshinShare = escapeshellarg($this->atoshinShare);
//
//$command = "node $scriptPath fractionalize -c $this->fractionContractAddress -n $this->nftContractAddress
//        -t $this->nftId -a $this->tokenName -s $this->tokenSymbol -u $this->totalSupply -h $this->galleryShare -i $this->atoshinShare 2>&1";
////        $command = "node C:/Users/arash/atoshin/scripts/deployFNFT.js fractionalize -c 0xb22482aA2c2A99fE73Aa7735d24057E2cE12B714 -n 0x5754217e78eAE5FF76C4411899D2c7e48a7D322A -t 0 -a Atosh_Lisa -s AA -u 100 -h 10 -i 10";
//$output = null;
//$returnVar = null;
//exec($command , $output, $returnVar);
//// Check if the command was successful
//if ($returnVar !== 0) {
//    // Join the output lines into a single error message
//    $errorMessage = implode("\n", $output);
//    throw new \Exception("JavaScript Error: " . $errorMessage);
//}
//// Decode JSON output
//$jsonString = implode("\n", $output);
//$decodedOutput = json_decode($jsonString, true);
//if ($decodedOutput == null) {
//    throw new \Exception("Error decoding JSON output from script.");
//}
//
//return $decodedOutput;
