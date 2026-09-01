<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class RfidController extends ResourceController
{
    public function index()
    {
        return $this->response->setJSON([
            'sucesso' => true,
            'mensagem' => 'API RFID funcionando!'
        ]);
    }
}