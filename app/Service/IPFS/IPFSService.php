<?php

namespace App\Service\IPFS;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class IPFSService
{
    protected $client;
    protected $baseUrl;
    protected $useInfura;

    public function __construct()
    {
        $this->useInfura = config('ipfs.use_infura'); // Boolean to toggle Infura or local IPFS
        $this->baseUrl = $this->useInfura ? config('ipfs.infura_base_url') : config('ipfs.local_base_url');

        $headers = [];
        if ($this->useInfura) {
            $headers['Authorization'] = 'Basic ' . base64_encode(config('ipfs.project_id') . ':' . config('ipfs.project_secret'));
        }

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => $headers,
        ]);
    }

    public function add($content): string
    {
        try {
            $response = $this->client->post('/api/v0/add', [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => $content,
                        'filename' => 'file', // Optional filename
                    ],
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['Hash'])) {
                return $data['Hash'];
            }

            throw new \Exception('IPFS hash not found in response');
        } catch (RequestException $e) {
            throw new \Exception('Failed to add file to IPFS: ' . $e->getMessage());
        }
    }
}
