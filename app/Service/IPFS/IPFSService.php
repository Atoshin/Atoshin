<?php

namespace App\Service\IPFS;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class IPFSService
{
protected $client;
protected $baseUrl;

public function __construct()
{
$this->baseUrl = config('ipfs.base_url', 'http://localhost:5001/api/v0');
$this->client = new Client([
'base_uri' => $this->baseUrl
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
'filename' => 'file' // You can specify the filename if needed
]
]
]);

// Assuming the response is in JSON format
$data = json_decode($response->getBody(), true);

if (isset($data['Hash'])) {
return $data['Hash'];
}

throw new \Exception('IPFS hash not found in response');
} catch (RequestException $e) {
throw new \Exception('Failed to add file to IPFS: ' . $e->getMessage());
}
}

// ...
}
