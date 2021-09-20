<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Notfound extends ResourceController
{
    public function ControllerNf()
    {
        
        $response = [
            'messages' => 'controller not found',
        ];

        return $this->fail($response,404,true);
    }

    public function MethodNf()
    {
        
        $response = [
            'messages' => 'method not found',
        ];

        return $this->fail($response,404,true);
    }
}
