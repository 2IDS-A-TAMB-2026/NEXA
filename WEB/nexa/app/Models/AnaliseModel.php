<?php

namespace App\Models;

use CodeIgniter\Model;

class OcorrenciaModel extends Model
{
    protected $table = 'ocorrencia';
    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'DATA_ANALISE',
        'HORA_ANALISE',
        'EPIS_DETECTADOS',
        'EPIS_AUSENTE',
        'STATUS_OCORRENCIA',
        'FK_ID_CAMERA'
    ];
}