<?php

namespace App\Controllers;

use App\Models\CamAdmModel;

class CamAdmController extends BaseController
{
    public function index()
    {
        $model = new CamAdmModel();

        $dados['camAdm'] = $model->findAll();

        return view('cam_adm/index', $dados);
    }

    public function inserir()
    {
        $model = new CamAdmModel();

        $dados = [
            'FK_ID_CAMERA' => $this->request->getPost('fk_id_camera'),
            'FK_CPF_ADMINISTRADOR' => $this->request->getPost('fk_cpf_administrador')
        ];

        $model->insert($dados);

        return redirect()->to('/cam-adm');
    }

    public function atualizar($id)
    {
        $model = new CamAdmModel();

        $dados = [
            'FK_ID_CAMERA' => $this->request->getPost('fk_id_camera'),
            'FK_CPF_ADMINISTRADOR' => $this->request->getPost('fk_cpf_administrador')
        ];

        $model->update($id, $dados);

        return redirect()->to('/cam-adm');
    }

    public function excluir($id)
    {
        $model = new CamAdmModel();

        $model->delete($id);

        return redirect()->to('/cam-adm');
    }

    public function editar($id)
    {
        $model = new CamAdmModel();

        $dados['registro'] = $model->find($id);

        return view('cam_adm/editar', $dados);
    }
}