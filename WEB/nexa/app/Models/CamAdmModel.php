<?php

namespace App\Models;

use CodeIgniter\Model;

class CamAdmModel extends Model
{
    protected $table = 'CAM_ADM';

    protected $primaryKey = 'ID';

    protected $returnType = 'array';

    protected $allowedFields = [
        'FK_ID_CAMERA',
        'FK_CPF_ADMINISTRADOR'
    ];
}