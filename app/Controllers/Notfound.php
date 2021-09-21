<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Notfound extends ResourceController
{
    public function ControllerNf()
    {
        $response = [
            'status' => 404,
            'error' => true,
            'messages' => 'controller not found',
        ];

        return $this->respond($response,404);
    }

    public function MethodNf()
    {
        $response = [
            'status' => 404,
            'error' => true,
            'messages' => 'method not found',
        ];

        return $this->respond($response,404);
    }
}
