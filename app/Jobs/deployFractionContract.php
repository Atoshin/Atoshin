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
        $client = new \GuzzleHttp\Client();
        $url =config('app.NODE_SERVER_URL').'/deploy';

        try {
            $response = $client->post($url, [
                'json' => [
                    'galleryAddress' => $this->galleryAddress
                ]
            ]);

            // Decode the JSON response
            return json_decode($response->getBody()->getContents(), true);

        } catch (\Exception $e) {
            return "Error: " . $e;
        }

    }
}
