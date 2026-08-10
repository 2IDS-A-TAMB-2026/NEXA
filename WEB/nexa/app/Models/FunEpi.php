<?php

namespace App\Models;

use CodeIgniter\Model;

class FunEpi extends Model
{
    protected $table = 'FUN_EPI';

    protected $primaryKey = 'ID';

    protected $returnType = 'array';

    protected $allowedFields = [
        'FK_FUNCIONARIO_CPF',
        'FK_EPI_ID'
    ];
}