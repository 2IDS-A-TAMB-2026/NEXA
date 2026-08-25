<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class EpiController extends ResourceController
{
    protected $format = 'json';

    /**
     * GET /api/funcionarios/{cpf}/epis
     *
     * Lista todos os EPIs de um funcionário.
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

        $epis = $db->table('FUN_EPI fe')
            ->select([
                'e.ID',
                'e.NOME_EPI',
                'e.IMAGEM_EPI',
                'e.DESCRICAO_EPI'
            ])
            ->join('EPI e', 'e.ID = fe.FK_EPI_ID')
            ->where('fe.FK_FUNCIONARIO_CPF', $cpf)
            ->orderBy('e.ID', 'ASC')
            ->get()
            ->getResultArray();

        return $this->respond([
            'status' => 200,
            'message' => 'EPIs encontrados com sucesso.',
            'total' => count($epis),
            'epis' => $epis
        ], 200);
    }

    /**
     * GET /api/epis/verificacoes/{cpf}
     *
     * Retorna as ocorrências relacionadas ao funcionário
     * e os EPIs envolvidos em cada ocorrência.
     */
    public function verificacoes($cpf = null)
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

        /*
         * Busca ocorrências relacionadas ao funcionário.
         */
        $builder = $db->table('FUN_OCORRENCIA fo');

        $builder->select([
            'o.ID',
            'o.DATA_ANALISE',
            'o.HORA_ANALISE',
            'o.EPIS_DETECTADOS',
            'o.EPIS_AUSENTE',
            'o.STATUS_OCORRENCIA',
            'o.FK_ID_CAMERA',
            'c.IDENTIFICADOR_CAMERA'
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

        $builder->where('fo.FK_FUNCIONARIO_CPF', $cpf);

        $builder->orderBy('o.DATA_ANALISE', 'DESC');
        $builder->orderBy('o.HORA_ANALISE', 'DESC');

        $ocorrencias = $builder->get()->getResultArray();

        /*
         * Para cada ocorrência, busca os EPIs relacionados
         * pela tabela OCORRENCIA_EPI.
         */
        foreach ($ocorrencias as &$ocorrencia) {

            $epis = $db->table('OCORRENCIA_EPI oe');

            $epis->select([
                'e.ID',
                'e.NOME_EPI',
                'e.IMAGEM_EPI',
                'e.DESCRICAO_EPI'
            ]);

            $epis->join(
                'EPI e',
                'e.ID = oe.FK_EPI_ID',
                'left'
            );

            $epis->where(
                'oe.FK_OCORRENCIA_ID',
                $ocorrencia['ID']
            );

            $ocorrencia['EPIS'] = $epis
                ->get()
                ->getResultArray();
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Verificações encontradas com sucesso.',
            'verificacoes' => $ocorrencias
        ], 200);
    }

    /**
     * GET /api/epis/{id}
     *
     * Busca um EPI específico.
     */
    public function show($id = null)
    {
        if (!$id) {
            return $this->respond([
                'status' => 400,
                'message' => 'ID do EPI não informado.'
            ], 400);
        }

        $db = Database::connect();

        $epi = $db->table('EPI')
            ->where('ID', $id)
            ->get()
            ->getRowArray();

        if (!$epi) {
            return $this->respond([
                'status' => 404,
                'message' => 'EPI não encontrado.'
            ], 404);
        }

        return $this->respond([
            'status' => 200,
            'message' => 'EPI encontrado com sucesso.',
            'data' => $epi
        ], 200);
    }
}
