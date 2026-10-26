<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OcorrenciaModel;
use App\Models\CameraModel;

class OcorrenciaController extends BaseController
{
    protected $ocorrenciaModel;

    public function __construct()
    {
        $this->ocorrenciaModel = new OcorrenciaModel();
    }

    // LISTAGEM
    public function index()
    {
        $sessao = session();

        // Verifica se o administrador está logado
        if (!$sessao->get('logado')) {
            return redirect()->to('/login');
        }

        // CNPJ da empresa do administrador logado
        $cnpjEmpresa = $sessao->get('cnpj_empresa');

        // Caso o CNPJ não esteja salvo na sessão,
        // busca pelo CPF do administrador logado.
        if (empty($cnpjEmpresa)) {
            $cpfAdministrador = $sessao->get('cpf');

            $administradorModel = new \App\Models\AdministradorModel();

            $administrador = $administradorModel
                ->where('CPF', $cpfAdministrador)
                ->first();

            if (!$administrador) {
                return redirect()->to('/login');
            }

            $cnpjEmpresa = $administrador['FK_CNPJ_EMPRESA']
                ?? $administrador['CNPJ_EMPRESA']
                ?? null;
        }

        // Sem empresa identificada, não exibe ocorrências
        if (empty($cnpjEmpresa)) {
            $dados['ocorrencias'] = [];

            return view('sistema/Ocorrencia/index', $dados);
        }

        // Busca somente ocorrências relacionadas a funcionários
        // pertencentes à empresa do administrador logado.
        $dados['ocorrencias'] = $this->ocorrenciaModel
            ->select('
                OCORRENCIA.*,
                CAMERA.IDENTIFICADOR_CAMERA,
                FUNCIONARIO.NOME_COMPLETO,
                SETOR.NOME AS SETOR
            ')
            ->join(
                'CAMERA',
                'CAMERA.ID = OCORRENCIA.FK_ID_CAMERA'
            )
            ->join(
                'FUN_OCORRENCIA',
                'FUN_OCORRENCIA.FK_ID_OCORRENCIA = OCORRENCIA.ID'
            )
            ->join(
                'FUNCIONARIO',
                'FUNCIONARIO.CPF = FUN_OCORRENCIA.FK_FUNCIONARIO_CPF'
            )
            ->join(
                'SETOR',
                'SETOR.ID = FUNCIONARIO.FK_ID_SETOR',
                'left'
            )
            ->where(
                'FUNCIONARIO.FK_CNPJ_EMPRESA',
                $cnpjEmpresa
            )
            ->orderBy('OCORRENCIA.DATA_ANALISE', 'DESC')
            ->orderBy('OCORRENCIA.HORA_ANALISE', 'DESC')
            ->findAll();

        return view('sistema/Ocorrencia/index', $dados);
    }

    // FORM NOVO
    public function novo()
    {
        $cameraModel = new CameraModel();

        $dados['cameras'] = $cameraModel->findAll();

        return view('sistema/Ocorrencia/novo', $dados);
    }

    // INSERIR
    public function inserir()
    {
        $dados = [
            'DATA_ANALISE' => $this->request->getPost('data_analise'),
            'HORA_ANALISE' => $this->request->getPost('hora_analise'),
            'EPIS_DETECTADOS' => $this->request->getPost('epis_detectados'),
            'EPIS_AUSENTE' => $this->request->getPost('epis_ausente'),
            'STATUS_OCORRENCIA' => $this->request->getPost('status_ocorrencia'),
            'FK_ID_CAMERA' => $this->request->getPost('fk_id_camera')
        ];

        $this->ocorrenciaModel->insert($dados);

        return redirect()->to('/Ocorrencia');
    }

    // FORM EDITAR
    public function editar($id)
    {
        $cameraModel = new CameraModel();

        $dados['ocorrencia'] = $this->ocorrenciaModel->find($id);
        $dados['cameras'] = $cameraModel->findAll();

        return view('sistema/Ocorrencia/editar', $dados);
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $dados = [
            'DATA_ANALISE' => $this->request->getPost('data_analise'),
            'HORA_ANALISE' => $this->request->getPost('hora_analise'),
            'EPIS_DETECTADOS' => $this->request->getPost('epis_detectados'),
            'EPIS_AUSENTE' => $this->request->getPost('epis_ausente'),
            'STATUS_OCORRENCIA' => $this->request->getPost('status_ocorrencia'),
            'FK_ID_CAMERA' => $this->request->getPost('fk_id_camera')
        ];

        $this->ocorrenciaModel->update($id, $dados);

        return redirect()->to('/Ocorrencia');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $this->ocorrenciaModel->delete($id);

        return redirect()->to('/Ocorrencia');
    }
}
