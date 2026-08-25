<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class PerfilController extends ResourceController
{
    protected $format = 'json';

    /**
     * GET /api/perfil/{cpf}
     *
     * Retorna todos os dados do perfil do funcionário.
     */
    public function show($cpf = null)
    {
        if (!$cpf) {
            return $this->respond([
                'status' => 400,
                'message' => 'CPF não informado.'
            ], 400);
        }

        $db = \Config\Database::connect();

        $funcionario = $db->table('FUNCIONARIO f')
            ->select(
                'f.CPF,
                f.NOME_COMPLETO,
                f.DATA_NASCIMENTO,
                f.EMAIL_CORPORATIVO,
                f.TELEFONE,
                f.UID_RFID,
                e.NOME AS EMPRESA,
                e.RUA,
                e.CEP,
                e.NUMERO,
                s.NOME AS SETOR,
                s.LOCAL AS LOCAL_SETOR'
            )
            ->join('EMPRESA e', 'e.CNPJ = f.FK_CNPJ_EMPRESA')
            ->join('SETOR s', 's.ID = f.FK_ID_SETOR', 'left')
            ->where('f.CPF', $cpf)
            ->get()
            ->getRowArray();

        if (!$funcionario) {
            return $this->respond([
                'status' => 404,
                'message' => 'Funcionário não encontrado.'
            ], 404);
        }

        $epis = $db->table('FUN_EPI fe')
            ->select('e.*')
            ->join('EPI e', 'e.ID = fe.FK_EPI_ID')
            ->where('fe.FK_FUNCIONARIO_CPF', $cpf)
            ->get()
            ->getResultArray();

        $funcionario['EPIS'] = $epis;

        return $this->respond([
            'status' => 200,
            'data' => $funcionario
        ]);
    }

    /**
     * PUT /api/perfil/{cpf}
     *
     * Atualiza dados básicos do funcionário.
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

        if (isset($dados['nome'])) {
            $atualizacao['NOME_COMPLETO'] = trim($dados['nome']);
        }

        if (isset($dados['email'])) {
            $atualizacao['EMAIL_CORPORATIVO'] = trim($dados['email']);
        }

        if (isset($dados['telefone'])) {
            $atualizacao['TELEFONE'] = trim($dados['telefone']);
        }

        if (empty($atualizacao)) {
            return $this->respond([
                'status' => 400,
                'message' => 'Nenhum campo válido foi enviado para atualização.'
            ], 400);
        }

        $db->table('FUNCIONARIO')
            ->where('CPF', $cpf)
            ->update($atualizacao);

        $funcionarioAtualizado = $db->table('FUNCIONARIO')
            ->where('CPF', $cpf)
            ->get()
            ->getRowArray();

        unset($funcionarioAtualizado['SENHA']);

        return $this->respond([
            'status' => 200,
            'message' => 'Perfil atualizado com sucesso.',
            'data' => $funcionarioAtualizado
        ], 200);
    }

    /**
     * PUT /api/perfil/{cpf}/senha
     *
     * Altera a senha do funcionário.
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

        $senhaAtual = $dados['senhaAtual'] ?? '';
        $novaSenha = $dados['novaSenha'] ?? '';

        if ($senhaAtual === '' || $novaSenha === '') {
            return $this->respond([
                'status' => 400,
                'message' => 'Senha atual e nova senha são obrigatórias.'
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

        if ($funcionario['SENHA'] !== $senhaAtual) {
            return $this->respond([
                'status' => 401,
                'message' => 'A senha atual está incorreta.'
            ], 401);
        }

        if (strlen($novaSenha) < 4) {
            return $this->respond([
                'status' => 400,
                'message' => 'A nova senha deve possuir pelo menos 4 caracteres.'
            ], 400);
        }

        $db->table('FUNCIONARIO')
            ->where('CPF', $cpf)
            ->update([
                'SENHA' => $novaSenha
            ]);

        return $this->respond([
            'status' => 200,
            'message' => 'Senha alterada com sucesso.'
        ], 200);
    }
}
