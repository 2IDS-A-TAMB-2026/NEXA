<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class AuthController extends ResourceController
{
    protected $format = 'json';

    /**
     * POST /api/login
     *
     * Login EXCLUSIVO do funcionário pelo aplicativo Mobile.
     */
    public function login()
    {
        $dados = $this->request->getJSON(true);

        if (!$dados) {
            return $this->respond([
                'status' => 400,
                'message' => 'Nenhum dado foi enviado.'
            ], 400);
        }

        $email = trim($dados['email'] ?? '');
        $senha = $dados['senha'] ?? '';

        if ($email === '' || $senha === '') {
            return $this->respond([
                'status' => 400,
                'message' => 'E-mail e senha são obrigatórios.'
            ], 400);
        }

        $db = Database::connect();

        // =====================================================
        // BUSCAR SOMENTE FUNCIONÁRIO
        // =====================================================

        $builder = $db->table('FUNCIONARIO f');

        $builder->select([
            'f.CPF',
            'f.NOME_COMPLETO',
            'f.DATA_NASCIMENTO',
            'f.EMAIL_CORPORATIVO',
            'f.TELEFONE',
            'f.UID_RFID',
            'f.SENHA',
            'f.FK_CNPJ_EMPRESA',
            'f.FK_ID_SETOR',
            'e.NOME AS EMPRESA',
            's.NOME AS SETOR'
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

        $builder->where(
            'f.EMAIL_CORPORATIVO',
            $email
        );

        $funcionario = $builder
            ->get()
            ->getRowArray();

        // =====================================================
        // FUNCIONÁRIO NÃO ENCONTRADO
        // =====================================================

        if (!$funcionario) {
            return $this->respond([
                'status' => 401,
                'message' => 'E-mail ou senha inválidos.'
            ], 401);
        }

        // =====================================================
        // VALIDAR SENHA
        // =====================================================

        if ($funcionario['SENHA'] !== $senha) {
            return $this->respond([
                'status' => 401,
                'message' => 'E-mail ou senha inválidos.'
            ], 401);
        }

        // =====================================================
        // RESPOSTA PARA O FLUTTER
        // =====================================================

        $usuario = [
            'cpf' => $funcionario['CPF'] ?? '',
            'nome' => $funcionario['NOME_COMPLETO'] ?? '',
            'email' => $funcionario['EMAIL_CORPORATIVO'] ?? '',
            'telefone' => $funcionario['TELEFONE'] ?? '',
            'dataNascimento' => $funcionario['DATA_NASCIMENTO'] ?? '',
            'uidRfid' => $funcionario['UID_RFID'] ?? '',
            'empresa' => $funcionario['EMPRESA'] ?? '',
            'setor' => $funcionario['SETOR'] ?? '',
            'cnpjEmpresa' => $funcionario['FK_CNPJ_EMPRESA'] ?? '',
            'idSetor' => $funcionario['FK_ID_SETOR'] ?? '',
            'role' => 'funcionário'
        ];

        return $this->respond([
            'status' => 200,
            'message' => 'Login realizado com sucesso.',
            'tipo' => 'FUNCIONARIO',
            'usuario' => $usuario
        ], 200);
    }

    /**
     * POST /api/logout
     */
    public function logout()
    {
        return $this->respond([
            'status' => 200,
            'message' => 'Logout realizado com sucesso.'
        ], 200);
    }
}