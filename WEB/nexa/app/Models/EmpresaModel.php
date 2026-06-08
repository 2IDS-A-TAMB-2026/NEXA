<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table = 'EMPRESA';

    protected $primaryKey = 'CNPJ';

    protected $allowedFields = [
        'CNPJ',
        'NOME',
        'RUA',
        'CEP',
        'NUMERO'
    ];

    protected $returnType = 'array';
}