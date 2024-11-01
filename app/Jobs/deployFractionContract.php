<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class deployFractionContract
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $galleryAddress;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($galleryAddress)
    {
        $this->galleryAddress = $galleryAddress;
    }

    /**
     * Execute the job.

     */
    public function handle()
    {
        $scriptPath = base_path('scripts/deployFNFT.js');
        $command = "node $scriptPath deploy -g $this->galleryAddress";

        $output = '';
        $returnVar = 0;
        exec($command . ' 2>&1', $output, $returnVar);

        // Check if the command was successful
        if ($returnVar !== 0) {
            // Join the output lines into a single error message
            $errorMessage = implode("\n", $output);
            throw new \Exception("JavaScript Error: " . $errorMessage);
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
