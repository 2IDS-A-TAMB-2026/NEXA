<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardCameraModel extends Model
{
    protected $table = 'CAMERA';
    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'STATUS',
        'IDENTIFICADOR_CAMERA',
        'FK_CNPJ_EMPRESA',
        'FK_ID_SETOR'
    ];

   public function listarCameras($filtro = null, $cnpjEmpresa = null)
{
    $builder = $this->db->table('CAMERA c');

    $builder->select('
        c.*,
        s.NOME AS SETOR
    ');

    $builder->join(
        'SETOR s',
        's.ID = c.FK_ID_SETOR',
        'left'
    );

    // FILTRO DA EMPRESA LOGADA
    if ($cnpjEmpresa) {
        $builder->where(
            'c.FK_CNPJ_EMPRESA',
            $cnpjEmpresa
        );
    }

    if (!empty($filtro)) {
        $builder->groupStart()
                ->like('c.IDENTIFICADOR_CAMERA', $filtro)
                ->orLike('s.NOME', $filtro)
                ->groupEnd();
    }

    return $builder->get()->getResultArray();
}
}