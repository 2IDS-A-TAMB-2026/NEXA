<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class PerfilController extends ResourceController
{
    protected $format = 'json';

    /**
     * =========================================================
     * GET /api/perfil/{cpf}
     * =========================================================
     */
    public function show($cpf = null)
    {
        if (!$cpf) {
            return $this->respond([
                'status' => 400,
                'message' => 'CPF não informado.'
            ], 400);
        }

        $db = Database::connect();

        // =====================================================
        // FUNCIONÁRIO
        // =====================================================

        $funcionario = $db->table('FUNCIONARIO f')
            ->select([
                'f.CPF',
                'f.NOME_COMPLETO',
                'f.DATA_NASCIMENTO',
                'f.EMAIL_CORPORATIVO',
                'f.TELEFONE',
                'f.UID_RFID',
                'f.FK_CNPJ_EMPRESA',
                'f.FK_ID_SETOR',
                'e.NOME AS EMPRESA',
                'e.RUA',
                'e.CEP',
                'e.NUMERO',
                's.NOME AS SETOR',
                's.LOCAL AS LOCAL_SETOR'
            ])
            ->join(
                'EMPRESA e',
                'e.CNPJ = f.FK_CNPJ_EMPRESA',
                'left'
            )
            ->join(
                'SETOR s',
                's.ID = f.FK_ID_SETOR',
                'left'
            )
            ->where('f.CPF', $cpf)
            ->get()
            ->getRowArray();

        if (!$funcionario) {
            return $this->respond([
                'status' => 404,
                'message' => 'Funcionário não encontrado.'
            ], 404);
        }

        // =====================================================
        // EPIs OBRIGATÓRIOS
        // =====================================================

        $epis = $db->table('FUN_EPI fe')
            ->select([
                'e.ID',
                'e.NOME_EPI',
                'e.IMAGEM_EPI',
                'e.DESCRICAO_EPI'
            ])
            ->join(
                'EPI e',
                'e.ID = fe.FK_EPI_ID',
                'inner'
            )
            ->where(
                'fe.FK_FUNCIONARIO_CPF',
                $cpf
            )
            ->get()
            ->getResultArray();

        // =====================================================
        // CONVERTER PARA UM FORMATO BOM PARA O FLUTTER
        // =====================================================

        $funcionario['EPIS'] = $epis;

        return $this->respond([
            'status' => 200,
            'data' => $funcionario
        ], 200);
    }

    /**
     * =========================================================
     * PUT /api/perfil/{cpf}
     *
     * Atualiza somente:
     * - Nome
     * - E-mail
     * - Telefone
     *
     * NÃO permite alterar:
     * - CPF
     * - Data nascimento
     * - RFID
     * - Empresa
     * - Setor
     * - EPIs
     * =========================================================
     */
    public function update($cpf = null)
    {
        if (!$cpf) {
            return $this->respond([
                'status' => 400,
                'message' => 'CPF do funcionário não informado.'
            ], 400);
        }

        $dados = $this->request->getJSON(true);

        if (!$dados) {
            return $this->respond([
                'status' => 400,
                'message' => 'Nenhum dado foi enviado.'
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

        $atualizacao = [];

        // =====================================================
        // NOME
        // =====================================================

        if (array_key_exists('nome', $dados)) {
            $nome = trim((string) $dados['nome']);

            if ($nome === '') {
                return $this->respond([
                    'status' => 400,
                    'message' => 'O nome não pode ficar vazio.'
                ], 400);
            }

            $atualizacao['NOME_COMPLETO'] = $nome;
        }

        // =====================================================
        // E-MAIL
        // =====================================================

        if (array_key_exists('email', $dados)) {
            $email = trim((string) $dados['email']);

            if ($email === '') {
                return $this->respond([
                    'status' => 400,
                    'message' => 'O e-mail não pode ficar vazio.'
                ], 400);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->respond([
                    'status' => 400,
                    'message' => 'Informe um e-mail válido.'
                ], 400);
            }

            $atualizacao['EMAIL_CORPORATIVO'] = $email;
        }

        // =====================================================
        // TELEFONE
        // =====================================================

        if (array_key_exists('telefone', $dados)) {
            $telefone = trim((string) $dados['telefone']);

            if ($telefone === '') {
                return $this->respond([
                    'status' => 400,
                    'message' => 'O telefone não pode ficar vazio.'
                ], 400);
            }

            $atualizacao['TELEFONE'] = $telefone;
        }

        // =====================================================
        // NÃO RECEBE CAMPOS PROTEGIDOS
        // =====================================================
        //
        // Mesmo que alguém tente mandar:
        //
        // cpf
        // dataNascimento
        // uidRfid
        // empresa
        // setor
        // epis
        //
        // eles serão simplesmente ignorados.
        //
        // =====================================================

        if (empty($atualizacao)) {
            return $this->respond([
                'status' => 400,
                'message' => 'Nenhum campo válido foi enviado para atualização.'
            ], 400);
        }

        $db->table('FUNCIONARIO')
            ->where('CPF', $cpf)
            ->update($atualizacao);

        return $this->respond([
            'status' => 200,
            'message' => 'Perfil atualizado com sucesso.'
        ], 200);
    }

    /**
     * =========================================================
     * PUT /api/perfil/{cpf}/senha
     * =========================================================
     *
     * Se novaSenha estiver vazia:
     * → NÃO altera a senha.
     *
     * =========================================================
     */
    public function senha($cpf = null)
    {
        if (!$cpf) {
            return $this->respond([
                'status' => 400,
                'message' => 'CPF do funcionário não informado.'
            ], 400);
        }

        $dados = $this->request->getJSON(true);

        if (!$dados) {
            return $this->respond([
                'status' => 400,
                'message' => 'Nenhum dado foi enviado.'
            ], 400);
        }

        $senhaAtual = trim((string) ($dados['senhaAtual'] ?? ''));
        $novaSenha = trim((string) ($dados['novaSenha'] ?? ''));

        // =====================================================
        // SENHA NOVA VAZIA = NÃO ALTERAR
        // =====================================================

        if ($novaSenha === '') {
            return $this->respond([
                'status' => 200,
                'message' => 'Senha não alterada.'
            ], 200);
        }

        // =====================================================
        // SENHA ATUAL OBRIGATÓRIA PARA TROCAR
        // =====================================================

        if ($senhaAtual === '') {
            return $this->respond([
                'status' => 400,
                'message' => 'Informe a senha atual para alterar a senha.'
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

        // =====================================================
        // VALIDAR SENHA ATUAL
        // =====================================================

        if (!password_verify(
            $senhaAtual,
            $funcionario['SENHA']
        )) {
            return $this->respond([
                'status' => 401,
                'message' => 'A senha atual está incorreta.'
            ], 401);
        }

        // =====================================================
        // TAMANHO DA NOVA SENHA
        // =====================================================

        if (strlen($novaSenha) < 4) {
            return $this->respond([
                'status' => 400,
                'message' => 'A nova senha deve possuir pelo menos 4 caracteres.'
            ], 400);
        }

        // =====================================================
        // CRIPTOGRAFAR NOVA SENHA
        // =====================================================

        $senhaHash = password_hash(
            $novaSenha,
            PASSWORD_DEFAULT
        );

        $db->table('FUNCIONARIO')
            ->where('CPF', $cpf)
            ->update([
                'SENHA' => $senhaHash
            ]);

        return $this->respond([
            'status' => 200,
            'message' => 'Senha alterada com sucesso.'
        ], 200);
    }
}