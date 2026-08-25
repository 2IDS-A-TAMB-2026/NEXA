<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class CameraController extends ResourceController
{
    protected $format = 'json';

    /**
     * GET /api/cameras
     *
     * Lista as câmeras cadastradas.
     */
    public function index()
    {
        $db = Database::connect();

        $builder = $db->table('CAMERA c');

        $builder->select([
            'c.ID',
            'c.STATUS',
            'c.IDENTIFICADOR_CAMERA',
            'c.FK_CNPJ_EMPRESA',
            'c.FK_ID_SETOR',
            'e.NOME AS EMPRESA',
            's.NOME AS SETOR',
            's.LOCAL AS LOCAL_SETOR'
        ]);

        $builder->join(
            'EMPRESA e',
            'e.CNPJ = c.FK_CNPJ_EMPRESA',
            'left'
        );

        $builder->join(
            'SETOR s',
            's.ID = c.FK_ID_SETOR',
            'left'
        );

        $builder->orderBy('c.ID', 'ASC');

        $cameras = $builder
            ->get()
            ->getResultArray();

        return $this->respond([
            'status' => 200,
            'message' => 'Câmeras encontradas com sucesso.',
            'total' => count($cameras),
            'cameras' => $cameras
        ], 200);
    }

    /**
     * GET /api/cameras/{id}
     *
     * Busca uma câmera específica.
     */
    public function show($id = null)
    {
        if (!$id) {
            return $this->respond([
                'status' => 400,
                'message' => 'ID da câmera não informado.'
            ], 400);
        }

        $db = Database::connect();

        $builder = $db->table('CAMERA c');

        $builder->select([
            'c.ID',
            'c.STATUS',
            'c.IDENTIFICADOR_CAMERA',
            'c.FK_CNPJ_EMPRESA',
            'c.FK_ID_SETOR',
            'e.NOME AS EMPRESA',
            's.NOME AS SETOR',
            's.LOCAL AS LOCAL_SETOR'
        ]);

        $builder->join(
            'EMPRESA e',
            'e.CNPJ = c.FK_CNPJ_EMPRESA',
            'left'
        );

        $builder->join(
            'SETOR s',
            's.ID = c.FK_ID_SETOR',
            'left'
        );

        $builder->where('c.ID', $id);

        $camera = $builder
            ->get()
            ->getRowArray();

        if (!$camera) {
            return $this->respond([
                'status' => 404,
                'message' => 'Câmera não encontrada.'
            ], 404);
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Câmera encontrada com sucesso.',
            'data' => $camera
        ], 200);
    }

    /**
     * POST /api/cameras/{id}/analisar
     *
     * Consulta a última análise registrada para a câmera.
     *
     * A IA não é executada aqui porque o banco atual
     * não possui uma tabela de processamento de imagens.
     * O resultado disponível no BD_NEXA está em OCORRENCIA.
     */
    public function analisar($id = null)
    {
        if (!$id) {
            return $this->respond([
                'status' => 400,
                'message' => 'ID da câmera não informado.'
            ], 400);
        }

        $db = Database::connect();

        $camera = $db->table('CAMERA')
            ->where('ID', $id)
            ->get()
            ->getRowArray();

        if (!$camera) {
            return $this->respond([
                'status' => 404,
                'message' => 'Câmera não encontrada.'
            ], 404);
        }

        /*
         * Última ocorrência/análise da câmera.
         */
        $builder = $db->table('OCORRENCIA o');

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
            'CAMERA c',
            'c.ID = o.FK_ID_CAMERA',
            'left'
        );

        $builder->where('o.FK_ID_CAMERA', $id);

        $builder->orderBy('o.DATA_ANALISE', 'DESC');
        $builder->orderBy('o.HORA_ANALISE', 'DESC');

        $analise = $builder
            ->get()
            ->getRowArray();

        if (!$analise) {
            return $this->respond([
                'status' => 404,
                'message' => 'Nenhuma análise registrada para esta câmera.'
            ], 404);
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Última análise encontrada.',
            'analise' => $analise
        ], 200);
    }
}
