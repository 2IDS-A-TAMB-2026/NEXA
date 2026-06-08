<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaAdmModel extends Model
{
    protected $table = 'EMPRESA_ADM';

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'FK_EMPRESA_CNPJ',
        'FK_ADMINISTRADOR_CPF'
    ];

    protected $returnType = 'array';
}