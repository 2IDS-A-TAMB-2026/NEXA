<?php

namespace App\Models;

use CodeIgniter\Model;

class FunOcorrenciaModel extends Model
{
    protected $table = 'FUN_OCORRENCIA';

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'FK_FUNCIONARIO_CPF',
        'FK_ID_OCORRENCIA'
    ];

    protected $returnType = 'array';
}