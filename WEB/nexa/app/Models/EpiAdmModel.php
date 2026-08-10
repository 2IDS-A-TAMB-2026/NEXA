<?php

namespace App\Models;

use CodeIgniter\Model;

class EpiAdmModel extends Model
{
    protected $table = 'EPI_ADM';

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'FK_EPI_ADM',
        'FK_ADMINISTRADOR_CPF'
    ];

    protected $returnType = 'array';
}