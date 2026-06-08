<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FuncionarioModel;

class FuncionarioController extends BaseController
{
    protected $funcionarioModel;

    public function __construct()
    {
        $this->funcionarioModel = new FuncionarioModel();
    }

    // LISTAR FUNCIONÁRIOS
    public function index()
    {
        $dados['funcionarios'] = $this->funcionarioModel->findAll();

        return view('Sistema/Cadastro_Fun/index', $dados);
    }

    // ABRIR FORMULÁRIO VAZIO
    public function novo()
    {
        return view('Sistema/Cadastro_Fun/index');
    }

    // CADASTRAR FUNCIONÁRIO (INSERT)
    public function inserir()
    {
        // Pega os dados vindos do formulário
        $dados = [
            'CPF'                => $this->request->getPost('CPF'),
            'NOME_COMPLETO'      => $this->request->getPost('NOME_COMPLETO'),
            'DATA_NASCIMENTO'    => $this->request->getPost('DATA_NASCIMENTO'),
            'EMAIL_CORPORATIVO'  => $this->request->getPost('EMAIL_CORPORATIVO'),
            'TELEFONE'           => $this->request->getPost('TELEFONE'),
            'UID_RFID'           => $this->request->getPost('UID_RFID'),
            'FK_CNPJ_EMPRESA'    => $this->request->getPost('FK_CNPJ_EMPRESA'),
            'FK_ID_SETOR'        => $this->request->getPost('FK_ID_SETOR')
        ];

        // Só encripta e envia a senha se ela tiver sido digitada
        $senha = $this->request->getPost('SENHA');
        if (!empty($senha)) {
            $dados['SENHA'] = password_hash($senha, PASSWORD_DEFAULT);
        }

        // Limpa apenas o CPF (deixando só números)
        $dados['CPF'] = preg_replace('/\D/', '', $dados['CPF']);

        // OBSERVAÇÃO: Deixamos o CNPJ exatamente como veio do formulário (com pontos/barras). 
        // Se o seu banco guardar o CNPJ SEM pontos, descomente a linha abaixo:
        // $dados['FK_CNPJ_EMPRESA'] = preg_replace('/\D/', '', $dados['FK_CNPJ_EMPRESA']);

        try {
            if ($this->funcionarioModel->insert($dados)) {
                return redirect()->to('/Cadastro_Fun')->with('sucesso', 'Funcionário cadastrado com sucesso!');
            } else {
                return redirect()->back()->with('erro', 'O Model recusou os dados. Verifique se os campos estão listados em $allowedFields no seu FuncionarioModel.');
            }
        } catch (\Exception $e) {
            // Se o CNPJ digitado não existir na tabela empresa, este catch vai mostrar o erro amigavelmente
            return redirect()->back()->with('erro', 'Erro de Validação/Banco: ' . $e->getMessage());
        }
    }

    // EDITAR FUNCIONÁRIO (UPDATE)
    public function editar()
    {
        // Pega o CPF do campo oculto (preenchido pelo JavaScript ao clicar em Editar)
        $cpfOriginal = $this->request->getPost('CPF_ORIGINAL');
        $cpfOriginalLimpo = preg_replace('/\D/', '', $cpfOriginal);

        if (empty($cpfOriginalLimpo)) {
            return redirect()->back()->with('erro', 'Identificador do funcionário não encontrado para atualizar.');
        }

        $dados = [
            'NOME_COMPLETO'      => $this->request->getPost('NOME_COMPLETO'),
            'DATA_NASCIMENTO'    => $this->request->getPost('DATA_NASCIMENTO'),
            'EMAIL_CORPORATIVO'  => $this->request->getPost('EMAIL_CORPORATIVO'),
            'TELEFONE'           => $this->request->getPost('TELEFONE'),
            'UID_RFID'           => $this->request->getPost('UID_RFID'),
            'FK_CNPJ_EMPRESA'    => $this->request->getPost('FK_CNPJ_EMPRESA'),
            'FK_ID_SETOR'        => $this->request->getPost('FK_ID_SETOR')
        ];

        // Limpa o CPF se ele tiver mudado
        if ($this->request->getPost('CPF')) {
            $dados['CPF'] = preg_replace('/\D/', '', $this->request->getPost('CPF'));
        }

        // Se o seu banco guardar o CNPJ SEM pontos, descomente o bloco abaixo:
        // if (!empty($dados['FK_CNPJ_EMPRESA'])) {
        //     $dados['FK_CNPJ_EMPRESA'] = preg_replace('/\D/', '', $dados['FK_CNPJ_EMPRESA']);
        // }

        $senha = $this->request->getPost('SENHA');
        if (!empty($senha)) {
            $dados['SENHA'] = password_hash($senha, PASSWORD_DEFAULT);
        }

        try {
            if (!$this->funcionarioModel->update($cpfOriginalLimpo, $dados)) {
                return redirect()->back()->with('erro', 'Erro ao atualizar os dados do funcionário.');
            }
            return redirect()->to('/Cadastro_Fun')->with('sucesso', 'Funcionário atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', 'Erro ao atualizar (Chave Estrangeira): ' . $e->getMessage());
        }
    }

    // EXCLUIR FUNCIONÁRIO (DELETE)
    public function excluir($cpf)
    {
        $cpfLimpo = preg_replace('/\D/', '', $cpf);

        $funcionario = $this->funcionarioModel->find($cpfLimpo);

        if (!$funcionario) {
            // Segunda tentativa caso esteja salvo com pontuação diretamente na base de dados
            $funcionario = $this->funcionarioModel->where('CPF', $cpf)->first();
            if (!$funcionario) {
                return redirect()->to('/Cadastro_Fun')->with('erro', 'Funcionário não encontrado.');
            }
            $cpfLimpo = $funcionario['CPF'];
        }

        $this->funcionarioModel->delete($cpfLimpo);

        return redirect()->to('/Cadastro_Fun')->with('sucesso', 'Funcionário excluído com sucesso!');
    }
}