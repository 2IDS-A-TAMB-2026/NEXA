<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class OcorrenciaController extends ResourceController
{
    protected $format = 'json';

    /**
     * GET /api/ocorrencias/funcionario/{cpf}
     *
     * Histórico de ocorrências do funcionário.
     */
    public function funcionario($cpf = null)
    {
        if (!$cpf) {
            return $this->respond([
                'status' => 400,
                'message' => 'CPF do funcionário não informado.'
            ], 400);
        }

        $db = Database::connect();

        $funcionario = $db->table('FUNCIONARIO')
            ->where('CPF', $cpf)
            ->get()
            ->getRowArray();

        if (!$funcionario) {
            return $this->respond([
                'status' => 404,
                'message' => 'Funcionário não encontrado.'
            ], 404);
        }

        $builder = $db->table('FUN_OCORRENCIA fo');

        $builder->select([
            'o.ID',
            'o.DATA_ANALISE',
            'o.HORA_ANALISE',
            'o.EPIS_DETECTADOS',
            'o.EPIS_AUSENTE',
            'o.STATUS_OCORRENCIA',
            'o.FK_ID_CAMERA',
            'c.IDENTIFICADOR_CAMERA',
            'c.STATUS AS STATUS_CAMERA',
            's.NOME AS SETOR'
        ]);

        $builder->join(
            'OCORRENCIA o',
            'o.ID = fo.FK_ID_OCORRENCIA',
            'left'
        );

        $builder->join(
            'CAMERA c',
            'c.ID = o.FK_ID_CAMERA',
            'left'
        );

        $builder->join(
            'SETOR s',
            's.ID = c.FK_ID_SETOR',
            'left'
        );

        $builder->where(
            'fo.FK_FUNCIONARIO_CPF',
            $cpf
        );

        $builder->orderBy(
            'o.DATA_ANALISE',
            'DESC'
        );

        $builder->orderBy(
            'o.HORA_ANALISE',
            'DESC'
        );

        $ocorrencias = $builder
            ->get()
            ->getResultArray();

        return $this->respond([
            'status' => 200,
            'message' => 'Ocorrências encontradas com sucesso.',
            'total' => count($ocorrencias),
            'ocorrencias' => $ocorrencias
        ], 200);
    }

    /**
     * GET /api/ocorrencias/{id}
     *
     * Busca uma ocorrência específica.
     */
    public function show($id = null)
    {
        if (!$id) {
            return $this->respond([
                'status' => 400,
                'message' => 'ID da ocorrência não informado.'
            ], 400);
        }

        $db = Database::connect();

        $builder = $db->table('OCORRENCIA o');

        $builder->select([
            'o.ID',
            'o.DATA_ANALISE',
            'o.HORA_ANALISE',
            'o.EPIS_DETECTADOS',
            'o.EPIS_AUSENTE',
            'o.STATUS_OCORRENCIA',
            'o.FK_ID_CAMERA',
            'c.IDENTIFICADOR_CAMERA',
            'c.STATUS AS STATUS_CAMERA',
            's.NOME AS SETOR'
        ]);

        $builder->join(
            'CAMERA c',
            'c.ID = o.FK_ID_CAMERA',
            'left'
        );

        $builder->join(
            'SETOR s',
            's.ID = c.FK_ID_SETOR',
            'left'
        );

        $builder->where('o.ID', $id);

        $ocorrencia = $builder
            ->get()
            ->getRowArray();

        if (!$ocorrencia) {
            return $this->respond([
                'status' => 404,
                'message' => 'Ocorrência não encontrada.'
            ], 404);
        }

        /*
         * Funcionários relacionados à ocorrência.
         */
        $funcionarios = $db->table('FUN_OCORRENCIA fo');

        $funcionarios->select([
            'f.CPF',
            'f.NOME_COMPLETO',
            'f.EMAIL_CORPORATIVO',
            'f.UID_RFID'
        ]);

        $funcionarios->join(
            'FUNCIONARIO f',
            'f.CPF = fo.FK_FUNCIONARIO_CPF',
            'left'
        );

        $funcionarios->where(
            'fo.FK_ID_OCORRENCIA',
            $id
        );

        $ocorrencia['FUNCIONARIOS'] = $funcionarios
            ->get()
            ->getResultArray();

        /*
         * EPIs relacionados à ocorrência.
         */
        $epis = $db->table('OCORRENCIA_EPI oe');

        $epis->select([
            'e.ID',
            'e.NOME_EPI',
            'e.IMAGEM_EPI',
            'e.DESCRICAO_EPI',
            'e.FK_CPF_FUNCIONARIO'
        ]);

        $epis->join(
            'EPI e',
            'e.ID = oe.FK_EPI_ID',
            'left'
        );

        $epis->where(
            'oe.FK_OCORRENCIA_ID',
            $id
        );

        $ocorrencia['EPIS'] = $epis
            ->get()
            ->getResultArray();

        return $this->respond([
            'status' => 200,
            'message' => 'Ocorrência encontrada com sucesso.',
            'data' => $ocorrencia
        ], 200);
    }
}
