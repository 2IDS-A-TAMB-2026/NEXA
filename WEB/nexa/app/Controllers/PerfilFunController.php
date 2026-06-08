<?php

namespace App\Controllers;

use App\Models\FuncionarioModel;

class PerfilFunController extends BaseController
{
 public function index()
{
    if (!session()->get('logado_fun'))
    {
        return redirect()->to('/loginfun');
    }

    $model = new FuncionarioModel();

    $cpf = session()->get('cpf');

    $funcionario = $model->find($cpf);

    return view('/sistema/PerfilFun/perfilfun', [
        'funcionario' => $funcionario
    ]);
}

   public function atualizar()
{
    $model = new FuncionarioModel();

    $cpf = session()->get('cpf');

    $dados = [
        'TELEFONE' => $this->request->getPost('telefone')
    ];

    $novaSenha = $this->request->getPost('novaSenha');

    if (!empty($novaSenha)) {
        $dados['SENHA'] = password_hash(
            $novaSenha,
            PASSWORD_DEFAULT
        );
    }

    $model->update($cpf, $dados);

    return redirect()->to('/perfilfun');
}
}