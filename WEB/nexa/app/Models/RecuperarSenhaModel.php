<?php

namespace App\Models;

use CodeIgniter\Model;



class RecuperarSenhaModel extends Model
{
    protected $table = 'RECUPERAR_SENHA';

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'EMAIL',
        'TOKEN',
        'EXPIRA_EM'
    ];

    protected $returnType = 'array';
}