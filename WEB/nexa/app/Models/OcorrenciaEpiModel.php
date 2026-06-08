<?php

namespace App\Models;

use CodeIgniter\Model;

class OcorrenciaEpiModel extends Model
{
    protected $table = 'OCORRENCIA_EPI';

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'FK_OCORRENCIA_ID',
        'FK_EPI_ID'
    ];

    protected $returnType = 'array';
}