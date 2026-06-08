<?php

namespace App\Models;

use CodeIgniter\Model;

class SetorModel extends Model
{
    protected $table = 'SETOR';

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'NOME',
        'LOCAL',
        'FK_CNPJ_EMPRESA'
    ];
    protected $returnType = 'array';
}