<?php

namespace App\Models;

use CodeIgniter\Model;

class AdministradorModel extends Model
{
    protected $table = 'ADMINISTRADOR';

    protected $primaryKey = 'CPF';

    protected $allowedFields = [
        'NOME_COMPLETO',
        'EMAIL_CORPORATIVO',
        'SENHA',
        'TELEFONE',
    ];

    protected $returnType = 'array';
}