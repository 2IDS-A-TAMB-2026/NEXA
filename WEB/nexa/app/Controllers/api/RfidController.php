<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class RfidController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $dados = $this->request->getJSON(true);

        if (!$dados) {
            return $this->respond([
                "sucesso" => false,
                "mensagem" => "Nenhum dado recebido."
            ], 400);
        }

        $uid = trim($dados["uid"] ?? "");

        if (empty($uid)) {
            return $this->respond([
                "sucesso" => false,
                "mensagem" => "UID não informado."
            ], 400);
        }

        // Remove espaços
        $uidBusca = strtoupper(
            str_replace(" ", "", $uid)
        );

        $db = Database::connect();

        // ============================================
        // FUNCIONÁRIO
        // ============================================

        $funcionario = $db->table("FUNCIONARIO f")

            ->select("
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
            ")

            ->join(
                "EMPRESA e",
                "e.CNPJ = f.FK_CNPJ_EMPRESA"
            )

            ->join(
                "SETOR s",
                "s.ID = f.FK_ID_SETOR"
            )

            ->where(
                "REPLACE(UPPER(f.UID_RFID),' ','')",
                $uidBusca
            )

            ->get()
            ->getRowArray();

        // ============================================
        // RFID NÃO ENCONTRADO
        // ============================================

        if (!$funcionario) {

            return $this->respond([
                "sucesso" => false,
                "acesso" => false,
                "mensagem" => "Cartão não cadastrado."
            ], 404);
        }

        // ============================================
        // BUSCAR CÂMERA
        // ============================================

        $camera = $db->table("CAMERA")

            ->where(
                "FK_ID_SETOR",
                $funcionario["SETOR_ID"]
            )

            ->where(
                "STATUS",
                "Ativo"
            )

            ->get()

            ->getRowArray();

        // ============================================
        // EPIS OBRIGATÓRIOS
        // ============================================

        $epis = $db->table("FUN_EPI fe")

            ->select("
                e.ID,
                e.NOME_EPI,
                e.IMAGEM_EPI
            ")

            ->join(
                "EPI e",
                "e.ID = fe.FK_EPI_ID"
            )

            ->where(
                "fe.FK_FUNCIONARIO_CPF",
                $funcionario["CPF"]
            )

            ->get()

            ->getResultArray();

        // ============================================
        // REGISTRAR SESSÃO TEMPORÁRIA
        // (Opcional para IA)
        // ============================================

        /*
        Você pode criar futuramente:

        RFID_SESSAO

        ID
        CPF
        CAMERA
        DATA
        STATUS

        Para a câmera saber quem passou.
        */

        // ============================================
        // RETORNO
        // ============================================

        return $this->respond([

            "sucesso" => true,

            "acesso" => true,

            "mensagem" =>
                "Funcionário identificado.",

            "funcionario" => [

                "cpf" =>
                    $funcionario["CPF"],

                "nome" =>
                    $funcionario["NOME_COMPLETO"],

                "email" =>
                    $funcionario["EMAIL_CORPORATIVO"],

                "telefone" =>
                    $funcionario["TELEFONE"],

                "uid" =>
                    $funcionario["UID_RFID"]
            ],

            "empresa" => [

                "cnpj" =>
                    $funcionario["CNPJ"],

                "nome" =>
                    $funcionario["EMPRESA"]
            ],

            "setor" => [

                "id" =>
                    $funcionario["SETOR_ID"],

                "nome" =>
                    $funcionario["SETOR"],

                "local" =>
                    $funcionario["LOCAL"]
            ],

            "camera" => $camera,

            "episObrigatorios" => $epis,

            "proximaEtapa" => [

                "acao" =>
                    "ANALISAR_EPI",

                "cameraId" =>
                    $camera["ID"] ?? null
            ]

        ]);
    }
}