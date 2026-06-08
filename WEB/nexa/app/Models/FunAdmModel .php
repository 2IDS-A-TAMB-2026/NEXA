<?php

namespace App\Models;

use CodeIgniter\Model;

class FunAdmModel extends Model
{
    protected $table = 'FUN_ADM';

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'FK_FUNCIONARIO_CPF',
        'FK_ADMINISTRADOR_CPF'
    ];

    protected $returnType = 'array';
}