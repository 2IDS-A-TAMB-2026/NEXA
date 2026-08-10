<?php

namespace App\Controllers;

use App\Models\FuncionarioModel;
use App\Models\FunEpi;
use App\Models\EpiModel;
class PerfilFunController extends BaseController
{
 public function index()
{
    
    if (!session()->get('logado_fun'))
    {
        return redirect()->to('/loginfun');
    }

    $funcionarioModel = new FuncionarioModel();
    $funEpiModel = new FunEpi(); // ou new FunEpi()
    $epiModel = new EpiModel();

    $cpf = session()->get('cpf_fun');

    $funcionario = $funcionarioModel->find($cpf);

    // Busca os vínculos do funcionário com EPIs
    $vinculos = $funEpiModel
        ->where('FK_FUNCIONARIO_CPF', $cpf)
        ->findAll();

    $epis = [];

    $epis = [];

foreach ($vinculos as $v)
{
    $epi = $epiModel->find($v['FK_EPI_ID']);

    if ($epi !== null)
    {
        $epis[] = $epi;
    }
}
    return view('/sistema/PerfilFun/perfilfun', [
        'funcionario' => $funcionario,
        'epis' => $epis
    ]);
}

   public function atualizar()
{
    $model = new FuncionarioModel();

    $cpf = session()->get('cpf_fun');

    $funcionario = $model->find($cpf);

    $dados = [
        'TELEFONE' => $this->request->getPost('telefone')
    ];

    $senhaAtual = $this->request->getPost('senhaAtual');
    $novaSenha = $this->request->getPost('novaSenha');

    if (!empty($novaSenha))
    {
       

        $dados['SENHA'] = password_hash(
            $novaSenha,
            PASSWORD_DEFAULT
        );
    }

    $model->update($cpf, $dados);

    return redirect()->to('/perfilfun');
}
}