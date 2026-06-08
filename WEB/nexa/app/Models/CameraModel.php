<?php

namespace App\Models;

use CodeIgniter\Model;

class CameraModel extends Model
{
    protected $table = 'camera';

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'IDENTIFICADOR_CAMERA',
        'STATUS',
        'FK_ID_SETOR',
        'FK_CNPJ_EMPRESA'
    ];

    protected $returnType = 'array';
}