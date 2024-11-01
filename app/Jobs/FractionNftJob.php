<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FractionNftJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $fractionContractAddress;
    protected $nftContractAddress;
    protected $nftId;
    protected $tokenName;
    protected $tokenSymbol;
    protected $totalSupply;
    protected $galleryShare;
    protected $atoshinShare;

    /**
     * Create a new job instance.
     */
    public function __construct($fractionContractAddress,$nftContractAddress,$nftId,$tokenName,$tokenSymbol, $totalSupply, $galleryShare, $atoshinShare)
    {
        $this->fractionContractAddress = $fractionContractAddress;
        $this->nftContractAddress = $nftContractAddress;
        $this->nftId = $nftId;
        $this->tokenName = $tokenName;
        $this->tokenSymbol = $tokenSymbol;
        $this->totalSupply = $totalSupply;
        $this->galleryShare = $galleryShare;
        $this->atoshinShare = $atoshinShare;

    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        
        $scriptPath = base_path('scripts/deployFNFT.js');
        $command = "node $scriptPath fractionalize -c $this->fractionContractAddress -n $this->nftContractAddress
        -t $this->nftId -a $this->tokenName -s $this->tokenSymbol -u $this->totalSupply -h $this->galleryShare -i $this->atoshinShare";
        $output = '';
        $returnVar = 0;

        exec($command . '2>&1', $output, $returnVar);
        // Check if the command was successful
        if ($returnVar !== 0) {
            // Join the output lines into a single error message
            $errorMessage = implode("\n", $output);
            throw new \Exception("JavaScript Error: " . $output);
        }
        // Decode JSON output
        $jsonString = implode("\n", $output);
        $decodedOutput = json_decode($jsonString, true);
        if ($decodedOutput == null) {

            throw new \Exception("Error decoding JSON output from script.");
        }

        return $decodedOutput;

    }
}
