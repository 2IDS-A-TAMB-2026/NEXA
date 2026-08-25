<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class DashboardController extends ResourceController
{
    protected $format = 'json';

    /**
     * GET /api/dashboard/{cpf}
     *
     * Retorna todos os dados necessários
     * para alimentar o dashboard do aplicativo.
     */
    public function index($cpf = null)
    {
        if (!$cpf) {
            return $this->respond([
                'status' => 400,
                'message' => 'CPF do funcionário não informado.'
            ], 400);
        }

        $db = Database::connect();

        /*
         * =========================================================
         * FUNCIONÁRIO
         * =========================================================
         */

        $builder = $db->table('FUNCIONARIO f');

        $builder->select([
            'f.CPF',
            'f.NOME_COMPLETO',
            'f.EMAIL_CORPORATIVO',
            'f.TELEFONE',
            'f.UID_RFID',
            'e.CNPJ',
            'e.NOME AS EMPRESA',
            's.ID AS SETOR_ID',
            's.NOME AS SETOR',
            's.LOCAL AS LOCAL_SETOR'
        ]);

        $builder->join(
            'EMPRESA e',
            'e.CNPJ = f.FK_CNPJ_EMPRESA',
            'left'
        );

        $builder->join(
            'SETOR s',
            's.ID = f.FK_ID_SETOR',
            'left'
        );

        $builder->where('f.CPF', $cpf);

        $funcionario = $builder->get()->getRowArray();

        if (!$funcionario) {
            return $this->respond([
                'status' => 404,
                'message' => 'Funcionário não encontrado.'
            ], 404);
        }

        /*
        * =========================================================
        * EPIs
        * =========================================================
        */

        $epis = $db->table('FUN_EPI fe')
            ->select(
                'e.ID,
                e.NOME_EPI,
                e.IMAGEM_EPI,
                e.DESCRICAO_EPI'
            )
            ->join('EPI e', 'e.ID = fe.FK_EPI_ID')
            ->where('fe.FK_FUNCIONARIO_CPF', $cpf)
            ->orderBy('e.ID', 'ASC')
            ->get()
            ->getResultArray();

        $totalEpis = count($epis);

        /*
         * =========================================================
         * OCORRÊNCIAS
         * =========================================================
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
            'c.IDENTIFICADOR_CAMERA',
            'c.STATUS AS STATUS_CAMERA'
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
         * =========================================================
         * ESTATÍSTICAS
         * =========================================================
         */

        $totalOcorrencias = count($ocorrencias);

        $ocorrenciasRegulares = 0;
        $ocorrenciasIrregulares = 0;

        foreach ($ocorrencias as $ocorrencia) {

            if (
                strtoupper($ocorrencia['STATUS_OCORRENCIA']) === 'REGULAR'
            ) {
                $ocorrenciasRegulares++;
            }

            if (
                strtoupper($ocorrencia['STATUS_OCORRENCIA']) === 'IRREGULAR'
            ) {
                $ocorrenciasIrregulares++;
            }
        }

        /*
         * =========================================================
         * ÚLTIMA VERIFICAÇÃO
         * =========================================================
         */

        $ultimaVerificacao = null;

        if (!empty($ocorrencias)) {
            $ultimaVerificacao = $ocorrencias[0];
        }

        /*
         * =========================================================
         * CÂMERAS DO SETOR
         * =========================================================
         */

        $cameras = [];

        if (!empty($funcionario['SETOR_ID'])) {

            $cameras = $db->table('CAMERA')
                ->where('FK_ID_SETOR', $funcionario['SETOR_ID'])
                ->orderBy('ID', 'ASC')
                ->get()
                ->getResultArray();
        }

        /*
         * =========================================================
         * RESPOSTA
         * =========================================================
         */

        return $this->respond([
            'status' => 200,
            'message' => 'Dashboard carregado com sucesso.',

            'funcionario' => $funcionario,

            'epis' => [
                'total' => $totalEpis,
                'lista' => $epis
            ],

            'ocorrencias' => [
                'total' => $totalOcorrencias,
                'regulares' => $ocorrenciasRegulares,
                'irregulares' => $ocorrenciasIrregulares,
                'ultima_verificacao' => $ultimaVerificacao,
                'historico' => $ocorrencias
            ],

            'cameras' => $cameras
        ], 200);
    }
}
