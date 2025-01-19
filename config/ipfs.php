<?php

return [
    'use_infura' => false, // Toggle between Infura and local IPFS
    'infura_base_url' => 'https://ipfs.infura.io:5001',
    'local_base_url' => 'http://127.0.0.1:5001',
    'project_id' => env('IPFS_INFURA_PROJECT_ID'),
    'project_secret' => env('IPFS_INFURA_PROJECT_SECRET'),
];
