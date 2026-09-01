<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class RfidController extends ResourceController
{
    protected $format = 'json';

    // =====================================================
    // POST /api/rfid
    // ESP32 ENVIA O UID
    // =====================================================

    public function index()
    {
        $dados = $this->request->getJSON(true);

        if (!$dados) {

            return $this->respond([
                'sucesso' => false,
                'acesso' => false,
                'mensagem' => 'Nenhum dado recebido.'
            ], 400);
        }

        $uid = trim($dados['uid'] ?? '');

        if (empty($uid)) {

            return $this->respond([
                'sucesso' => false,
                'acesso' => false,
                'mensagem' => 'UID não informado.'
            ], 400);
        }

        // =================================================
        // NORMALIZAR UID
        // =================================================

        $uidBusca = strtoupper(
            str_replace(' ', '', $uid)
        );

        $db = Database::connect();

        // =================================================
        // BUSCAR FUNCIONÁRIO
        // =================================================

        $funcionario = $db
            ->table('FUNCIONARIO f')

            ->select('
                f.CPF,
                f.NOME_COMPLETO,
                f.EMAIL_CORPORATIVO,
                f.TELEFONE,
                f.UID_RFID,

                e.CNPJ,
                e.NOME AS EMPRESA,

                s.ID AS SETOR_ID,
                s.NOME AS SETOR,
                s.LOCAL
            ')

            ->join(
                'EMPRESA e',
                'e.CNPJ = f.FK_CNPJ_EMPRESA'
            )

            ->join(
                'SETOR s',
                's.ID = f.FK_ID_SETOR'
            )

            ->where(
                "REPLACE(UPPER(f.UID_RFID),' ','')",
                $uidBusca
            )

            ->get()
            ->getRowArray();

        // =================================================
        // CARTÃO NÃO CADASTRADO
        // =================================================

        if (!$funcionario) {

            return $this->respond([
                'sucesso' => false,
                'acesso' => false,
                'mensagem' => 'Cartão não cadastrado.',
                'uid' => $uid
            ], 404);
        }

        // =================================================
        // BUSCAR CÂMERA
        // =================================================

        $camera = $db
            ->table('CAMERA')

            ->where(
                'FK_ID_SETOR',
                $funcionario['SETOR_ID']
            )

            ->where(
                'FK_CNPJ_EMPRESA',
                $funcionario['CNPJ']
            )

            ->where(
                'STATUS',
                'Ativo'
            )

            ->get()
            ->getRowArray();

        // =================================================
        // BUSCAR EPIs
        // =================================================

        $epis = $db
            ->table('FUN_EPI fe')

            ->select('
                e.ID,
                e.NOME_EPI,
                e.IMAGEM_EPI
            ')

            ->join(
                'EPI e',
                'e.ID = fe.FK_EPI_ID'
            )

            ->where(
                'fe.FK_FUNCIONARIO_CPF',
                $funcionario['CPF']
            )

            ->get()
            ->getResultArray();

        // =================================================
        // SE NÃO TEM CÂMERA
        // =================================================

        if (!$camera) {

            return $this->respond([

                'sucesso' => true,

                'acesso' => false,

                'mensagem' =>
                    'Funcionário encontrado, mas não existe câmera ativa para o setor.',

                'funcionario' => [

                    'cpf' =>
                        $funcionario['CPF'],

                    'nome' =>
                        $funcionario['NOME_COMPLETO'],

                    'email' =>
                        $funcionario['EMAIL_CORPORATIVO']
                ]

            ], 200);
        }

        // =================================================
        // LIMPAR SESSÕES RFID ANTIGAS
        // =================================================

        $db
            ->table('RFID_SESSAO')
            ->where('STATUS', 'PENDENTE')
            ->update([
                'STATUS' => 'EXPIRADA'
            ]);

        // =================================================
        // CRIAR NOVA SESSÃO RFID
        // =================================================

        $db
            ->table('RFID_SESSAO')
            ->insert([

                'CPF_FUNCIONARIO' =>
                    $funcionario['CPF'],

                'CAMERA_ID' =>
                    $camera['ID'],

                'STATUS' =>
                    'PENDENTE',

                'CRIADO_EM' =>
                    date('Y-m-d H:i:s')
            ]);

        // =================================================
        // RETORNAR PARA O ESP32
        // =================================================

        return $this->respond([

            'sucesso' => true,

            'acesso' => true,

            'mensagem' =>
                'Funcionário identificado.',

            'funcionario' => [

                'cpf' =>
                    $funcionario['CPF'],

                'nome' =>
                    $funcionario['NOME_COMPLETO'],

                'email' =>
                    $funcionario['EMAIL_CORPORATIVO'],

                'telefone' =>
                    $funcionario['TELEFONE'],

                'uid' =>
                    $funcionario['UID_RFID']
            ],

            'empresa' => [

                'cnpj' =>
                    $funcionario['CNPJ'],

                'nome' =>
                    $funcionario['EMPRESA']
            ],

            'setor' => [

                'id' =>
                    $funcionario['SETOR_ID'],

                'nome' =>
                    $funcionario['SETOR'],

                'local' =>
                    $funcionario['LOCAL']
            ],

            'camera' => [

                'id' =>
                    $camera['ID'],

                'identificador' =>
                    $camera['IDENTIFICADOR_CAMERA'],

                'status' =>
                    $camera['STATUS']
            ],

            'episObrigatorios' =>
                $epis,

            'proximaEtapa' => [

                'acao' =>
                    'ANALISAR_EPI',

                'cameraId' =>
                    $camera['ID']
            ]

        ], 200);
    }


    // =====================================================
    // GET /api/rfid/status
    //
    // O FRONT CONSULTA ESSA ROTA
    // =====================================================

    public function status()
    {
        $db = Database::connect();

        // =================================================
        // PEGAR ÚLTIMO RFID PENDENTE
        // =================================================

        $sessao = $db
            ->table('RFID_SESSAO r')

            ->select('
                r.ID,
                r.CPF_FUNCIONARIO,
                r.CAMERA_ID,
                r.STATUS,

                f.NOME_COMPLETO,
                f.EMAIL_CORPORATIVO,

                c.ID AS CAMERA_ID_REAL,
                c.IDENTIFICADOR_CAMERA,

                e.CNPJ,
                e.NOME AS EMPRESA,

                s.ID AS SETOR_ID,
                s.NOME AS SETOR,
                s.LOCAL
            ')

            ->join(
                'FUNCIONARIO f',
                'f.CPF = r.CPF_FUNCIONARIO'
            )

            ->join(
                'CAMERA c',
                'c.ID = r.CAMERA_ID',
                'left'
            )

            ->join(
                'EMPRESA e',
                'e.CNPJ = f.FK_CNPJ_EMPRESA'
            )

            ->join(
                'SETOR s',
                's.ID = f.FK_ID_SETOR',
                'left'
            )

            ->where(
                'r.STATUS',
                'PENDENTE'
            )

            ->orderBy(
                'r.ID',
                'DESC'
            )

            ->limit(1)

            ->get()

            ->getRowArray();


        // =================================================
        // NENHUM CARTÃO
        // =================================================

        if (!$sessao) {

            return $this->respond([

                'sucesso' => true,

                'novoAcesso' => false

            ], 200);
        }


        // =================================================
        // VERIFICAR SE É RECENTE
        // =================================================

        $criado = strtotime(
            $db
                ->table('RFID_SESSAO')
                ->where('ID', $sessao['ID'])
                ->get()
                ->getRowArray()['CRIADO_EM']
        );

        /*
         * Se o cartão tiver mais de 30 segundos,
         * considera expirado.
         */

        if (
            (time() - $criado) > 30
        ) {

            $db
                ->table('RFID_SESSAO')
                ->where(
                    'ID',
                    $sessao['ID']
                )
                ->update([
                    'STATUS' => 'EXPIRADA'
                ]);

            return $this->respond([

                'sucesso' => true,

                'novoAcesso' => false

            ], 200);
        }


        // =================================================
        // CRIAR LOGIN DO FUNCIONÁRIO
        // =================================================

        session()->set([

            'cpf_fun' =>
                $sessao['CPF_FUNCIONARIO'],

            'nome_fun' =>
                $sessao['NOME_COMPLETO'],

            'email_fun' =>
                $sessao['EMAIL_CORPORATIVO'],

            'logado_fun' =>
                true,

            'rfid_login' =>
                true,

            'camera_rfid' =>
                $sessao['CAMERA_ID']

        ]);


        // =================================================
        // MARCAR COMO CONSUMIDA
        // =================================================

        $db
            ->table('RFID_SESSAO')
            ->where(
                'ID',
                $sessao['ID']
            )
            ->update([

                'STATUS' =>
                    'CONSUMIDA'

            ]);


        // =================================================
        // RETORNO
        // =================================================

        return $this->respond([

            'sucesso' => true,

            'novoAcesso' => true,

            'redirect' =>
                base_url('camera_analise'),

            'funcionario' => [

                'cpf' =>
                    $sessao['CPF_FUNCIONARIO'],

                'nome' =>
                    $sessao['NOME_COMPLETO'],

                'email' =>
                    $sessao['EMAIL_CORPORATIVO']

            ],

            'camera' => [

                'id' =>
                    $sessao['CAMERA_ID_REAL'],

                'identificador' =>
                    $sessao['IDENTIFICADOR_CAMERA']

            ],

            'setor' => [

                'id' =>
                    $sessao['SETOR_ID'],

                'nome' =>
                    $sessao['SETOR'],

                'local' =>
                    $sessao['LOCAL']

            ]

        ], 200);
    }
}