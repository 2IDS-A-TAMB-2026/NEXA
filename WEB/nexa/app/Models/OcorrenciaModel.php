<?php

namespace App\Models;

use CodeIgniter\Model;

class OcorrenciaModel extends Model
{
    protected $table = 'OCORRENCIA';

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'DATA_ANALISE',
        'HORA_ANALISE',
        'EPIS_DETECTADOS',
        'EPIS_AUSENTE',
        'STATUS_OCORRENCIA',
        'FK_ID_CAMERA'
    ];

    protected $returnType = 'array';
public function getByFuncionario($cpf)
{
    return $this->db->table('OCORRENCIA o')
        ->select('
            o.ID,
            o.DATA_ANALISE,
            o.HORA_ANALISE,
            o.STATUS_OCORRENCIA,
            o.EPIS_DETECTADOS,
            o.EPIS_AUSENTE,
            c.IDENTIFICADOR_CAMERA,
            f.NOME_COMPLETO,
            s.NOME AS SETOR
        ')
        ->join('FUN_OCORRENCIA fo', 'fo.FK_ID_OCORRENCIA = o.ID')
        ->join('FUNCIONARIO f', 'f.CPF = fo.FK_FUNCIONARIO_CPF')
        ->join('SETOR s', 's.ID = f.FK_ID_SETOR')
        ->join('CAMERA c', 'c.ID = o.FK_ID_CAMERA')
        ->where('fo.FK_FUNCIONARIO_CPF', $cpf)
        ->get()
        ->getResultArray();
}
}