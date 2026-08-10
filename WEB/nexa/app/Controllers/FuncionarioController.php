<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FuncionarioModel;
use App\Models\FunEpi;
use App\Models\EpiModel;

class FuncionarioController extends BaseController
{
    protected $funcionarioModel;

    public function __construct()
    {
        $this->funcionarioModel = new FuncionarioModel();
    }

    // LISTAR FUNCIONÁRIOS
 public function index() {
    $epiModel = new \App\Models\EpiModel();
    // Busca todos os EPIs cadastrados no banco
    $data['lista_de_todos_epis'] = $epiModel->findAll(); 
    
    // Busca funcionários (o que você já deve ter)
    $funcionarioModel = new \App\Models\FunEpi();
    $data['funcionarios'] = $funcionarioModel->findAll();
    
    return view('Sistema/Cadastro_Fun/index', $data);
}
    // ABRIR FORMULÁRIO VAZIO
    public function novo()
    {
        return view('Sistema/Cadastro_Fun/index');
    }

    // CADASTRAR FUNCIONÁRIO (INSERT)
    public function inserir()
{
    // 1. Coleta e limpa o CPF
    $cpf = preg_replace('/\D/', '', $this->request->getPost('CPF'));
    $episSelecionados = $this->request->getPost('EPIS'); // Array com IDs selecionados

    // 2. Monta o array de dados para o Funcionário
    $dados = [
        'CPF'               => $cpf,
        'NOME_COMPLETO'     => $this->request->getPost('NOME_COMPLETO'),
        'DATA_NASCIMENTO'   => $this->request->getPost('DATA_NASCIMENTO'),
        'EMAIL_CORPORATIVO' => $this->request->getPost('EMAIL_CORPORATIVO'),
        'TELEFONE'          => $this->request->getPost('TELEFONE'),
        'UID_RFID'          => $this->request->getPost('UID_RFID'),
        'FK_CNPJ_EMPRESA'   => $this->request->getPost('FK_CNPJ_EMPRESA'),
        'FK_ID_SETOR'       => $this->request->getPost('FK_ID_SETOR'),
        'FK_FUNCIONARIO_CPF' => $this->request->getPost('FK_FUNCIONARIO_CPF'),
        'FK_EPI_ID'         => $this->request->getPost('FK_EPI_ID')
    ];

    $senha = $this->request->getPost('SENHA');
    if (!empty($senha)) {
        $dados['SENHA'] = password_hash($senha, PASSWORD_DEFAULT);
    }

    try {
        // 3. Tenta inserir o funcionário
        if ($this->funcionarioModel->insert($dados)) {
            
            // 4. Lógica de Verificação de Duplicidade nos EPIs
            if (!empty($episSelecionados)) {
                $db = \Config\Database::connect();
                $funEpiTable = $db->table('FUN_EPI');

                foreach ($episSelecionados as $epiId) {
                    // Verifica se já existe esse vínculo
                    $existe = $funEpiTable
                        ->where('FK_FUNCIONARIO_CPF', $cpf)
                        ->where('FK_EPI_ID', $epiId)
                        ->countAllResults();

                    // Se countAllResults for 0, insere. Se for > 0, já existe.
                    if ($existe == 0) {
                        $funEpiTable->insert([
                            'FK_FUNCIONARIO_CPF' => $cpf,
                            'FK_EPI_ID' => $epiId
                        ]);
                    }
                    // Opcional: Se quiser avisar o usuário que um EPI foi pulado, 
                    // você pode adicionar um log ou array de avisos aqui.
                }
            }
            return redirect()->to('/Cadastro_Fun')->with('sucesso', 'Funcionário cadastrado com sucesso!');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('erro', 'Erro ao processar cadastro: ' . $e->getMessage());
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