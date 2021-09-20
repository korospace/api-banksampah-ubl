<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Home extends ResourceController
{
    public function index()
    {
        $response = [
            'messages'      => 'welcome to BankSampah Budiluhur API',
            'documentation' => 'https://github.com/korospace/api-banksampah-ubl',
        ];

        return $this->respond($response,200);
    }
}
