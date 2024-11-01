<?php


namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MintNFTJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $galleryAddress;
    protected $metadataUri;

    public function __construct($galleryAddress, $metadataUri)
    {
        $this->galleryAddress = $galleryAddress;
        $this->metadataUri = $metadataUri;
    }

    public function handle()
    {
        $scriptPath = base_path('scripts/nft_interaction.js');
        $command = 'node ' . escapeshellarg($scriptPath) . ' ' . escapeshellarg($this->galleryAddress) . ' ' . escapeshellarg($this->metadataUri);

        // Capture output and errors
        $output = [];
        $returnVar = 0;
        exec($command . ' 2>&1', $output, $returnVar); // Redirect stderr to stdout

        // Check if the command was successful
        if ($returnVar !== 0) {
            // Join the output lines into a single error message
            $errorMessage = implode("\n", $output);
            throw new \Exception("JavaScript Error: " . $errorMessage);
        }

        // Return the tokenId from the output
        $tokenId = trim(implode("\n", $output));
        return $tokenId;
    }

}
