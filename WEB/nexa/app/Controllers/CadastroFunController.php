<?php

namespace App\Controllers;

use App\Models\AdministradorModel;
use App\Models\FuncionarioModel;
use App\Models\SetorModel;
use App\Models\EpiAdmModel;
use App\Models\EpiModel;
use App\Models\FunEpi;

class CadastroFunController extends BaseController
{
    /**
     * ============================================================
     * PÁGINA DE CADASTRO
     * ============================================================
     */
    public function index()
    {
        $model = new FuncionarioModel();
        $modelAdm = new AdministradorModel();
        $modelSetor = new SetorModel();
        $funEpiModel = new FunEpi();
        $modelEpi = new EpiModel();
        $modelEpiAdm = new EpiAdmModel();

        /*
        ============================================================
        BUSCAR ADMINISTRADOR LOGADO
        ============================================================
        */

        $cpfAdm = session()->get('cpf');

        if (empty($cpfAdm)) {
            return redirect()
                ->to('/login')
                ->with('erro', 'Sessão expirada. Faça login novamente.');
        }

        $dadosAdm = $modelAdm->find($cpfAdm);

        if (!$dadosAdm) {
            return redirect()
                ->to('/login')
                ->with('erro', 'Administrador não encontrado.');
        }

        $cnpjEmpresa = $dadosAdm['FK_CNPJ_EMPRESA'];

        /*
        ============================================================
        BUSCAR FUNCIONÁRIOS DA EMPRESA
        ============================================================
        */

        $dados['funcionarios'] = $model
            ->where('FK_CNPJ_EMPRESA', $cnpjEmpresa)
            ->findAll();

        /*
        ============================================================
        BUSCAR EPIS DE CADA FUNCIONÁRIO
        ============================================================
        */

        foreach ($dados['funcionarios'] as &$funcionario) {

            $episFun = $funEpiModel
                ->where(
                    'FK_FUNCIONARIO_CPF',
                    $funcionario['CPF']
                )
                ->findAll();

            $funcionario['EPIS'] = [];

            foreach ($episFun as $epiFun) {

                if (empty($epiFun['FK_EPI_ID'])) {
                    continue;
                }

                $epi = $modelEpi->find(
                    $epiFun['FK_EPI_ID']
                );

                if ($epi) {

                    $funcionario['EPIS'][] = [
                        'id' => $epi['ID'],
                        'nome' => $epi['NOME_EPI']
                    ];
                }
            }
        }

        unset($funcionario);

        /*
        ============================================================
        BUSCAR SETORES DA EMPRESA
        ============================================================
        */

        $dados['setores'] = $modelSetor
            ->where(
                'FK_CNPJ_EMPRESA',
                $cnpjEmpresa
            )
            ->findAll();

        /*
        ============================================================
        BUSCAR EPIS DA EMPRESA
        ============================================================

        EPI não possui CNPJ diretamente.

        Relação:

        EPI
          ↓
        EPI_ADM
          ↓
        ADMINISTRADOR
          ↓
        EMPRESA

        Portanto, pegamos os EPIs vinculados aos administradores
        pertencentes à mesma empresa do administrador logado.
        ============================================================
        */

        $administradoresEmpresa = $modelAdm
            ->where(
                'FK_CNPJ_EMPRESA',
                $cnpjEmpresa
            )
            ->findAll();

        $cpfsAdministradores = array_column(
            $administradoresEmpresa,
            'CPF'
        );

        $idsEpis = [];

        if (!empty($cpfsAdministradores)) {

            $episAdm = $modelEpiAdm
                ->whereIn(
                    'FK_ADMINISTRADOR_CPF',
                    $cpfsAdministradores
                )
                ->findAll();

            $idsEpis = array_column(
                $episAdm,
                'FK_EPI_ADM'
            );

            $idsEpis = array_values(
                array_unique($idsEpis)
            );
        }

        /*
        ============================================================
        BUSCAR EPIS
        ============================================================
        */

        if (!empty($idsEpis)) {

            $dados['epis'] = $modelEpi
                ->whereIn(
                    'ID',
                    $idsEpis
                )
                ->findAll();

        } else {

            $dados['epis'] = [];
        }

        /*
        ============================================================
        ENVIAR DADOS PARA A VIEW
        ============================================================
        */

        return view(
            'sistema/Cadastro_Fun/index',
            $dados
        );
    }


    /**
     * ============================================================
     * INSERIR FUNCIONÁRIO
     * ============================================================
     */
    public function inserir()
    {
        $model = new FuncionarioModel();
        $modelAdm = new AdministradorModel();

        /*
        ============================================================
        ADMINISTRADOR LOGADO
        ============================================================
        */

        $cpfAdm = session()->get('cpf');

        if (empty($cpfAdm)) {
            return redirect()
                ->to('/login')
                ->with('erro', 'Sessão expirada. Faça login novamente.');
        }

        $dadosAdm = $modelAdm->find($cpfAdm);

        if (!$dadosAdm) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    'Administrador não encontrado.'
                );
        }

        /*
        ============================================================
        CPF
        ============================================================
        */

        $cpf = $this->formatarCPF(
            $this->request->getPost('CPF')
        );

        if (empty($cpf)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    'Digite um CPF.'
                );
        }

        /*
        ============================================================
        VALIDAR CPF
        ============================================================
        */

        $cpfNumerico = preg_replace(
            '/\D/',
            '',
            $cpf
        );

        if (!$this->validarCPF($cpfNumerico)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    'CPF inválido.'
                );
        }

        /*
        ============================================================
        VERIFICAR CPF DUPLICADO
        ============================================================
        */

        $cpfExistente = $model
            ->where('CPF', $cpf)
            ->first();

        if ($cpfExistente) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    'Este CPF já está cadastrado.'
                );
        }

        /*
        ============================================================
        DADOS DO FUNCIONÁRIO
        ============================================================
        */

        $senha = (string) $this->request->getPost('SENHA');
        $confirmarSenha = (string) $this->request->getPost('CONFIRMAR_SENHA');

        if (empty($senha)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    'Digite uma senha.'
                );
        }

        if (strlen($senha) < 6) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    'A senha deve ter no mínimo 6 caracteres.'
                );
        }

        if ($senha !== $confirmarSenha) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    'A senha e a confirmação de senha devem ser iguais.'
                );
        }

        $dados = [

            'CPF' =>
                $cpf,

            'NOME_COMPLETO' =>
                trim(
                    $this->request->getPost(
                        'NOME_COMPLETO'
                    )
                ),

            'DATA_NASCIMENTO' =>
                $this->request->getPost(
                    'DATA_NASCIMENTO'
                ),

            'EMAIL_CORPORATIVO' =>
                trim(
                    $this->request->getPost(
                        'EMAIL_CORPORATIVO'
                    )
                ),

            'TELEFONE' =>
                trim(
                    $this->request->getPost(
                        'TELEFONE'
                    )
                ),

            /*
            ========================================================
            RFID
            ========================================================
            */

            'UID_RFID' =>
                trim(
                    $this->request->getPost(
                        'UID_RFID'
                    )
                ),

            /*
            ========================================================
            EMPRESA DO ADMINISTRADOR LOGADO
            ========================================================
            */

            'FK_CNPJ_EMPRESA' =>
                $dadosAdm['FK_CNPJ_EMPRESA'],

            /*
            ========================================================
            SETOR
            ========================================================
            */

            'FK_ID_SETOR' =>
                $this->request->getPost(
                    'FK_ID_SETOR'
                ),

            /*
            ========================================================
            SENHA
            ========================================================
            */

            'SENHA' =>
                password_hash(
                    $senha,
                    PASSWORD_DEFAULT
                )
        ];

        /*
        ============================================================
        VALIDAR CAMPOS OBRIGATÓRIOS
        ============================================================
        */

        if (
            empty($dados['NOME_COMPLETO']) ||
            empty($dados['DATA_NASCIMENTO']) ||
            empty($dados['EMAIL_CORPORATIVO']) ||
            empty($dados['TELEFONE']) ||
            empty($dados['UID_RFID']) ||
            empty($dados['FK_ID_SETOR'])
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    'Preencha todos os campos obrigatórios.'
                );
        }

        /*
        ============================================================
        CADASTRAR
        ============================================================
        */

        if (!$model->insert($dados)) {

            $erros = $model->errors();

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    !empty($erros)
                        ? implode('<br>', $erros)
                        : 'Não foi possível cadastrar o funcionário.'
                );
        }

        /*
        ============================================================
        SALVAR EPIS
        ============================================================
        */

        $this->salvarEpisFuncionario(
            $cpf,
            $dadosAdm['FK_CNPJ_EMPRESA']
        );

        /*
        ============================================================
        SUCESSO
        ============================================================
        */

        return redirect()
            ->to('/cadastro-funcionario')
            ->with(
                'sucesso',
                'Funcionário cadastrado com sucesso!'
            );
    }


    /**
     * ============================================================
     * EDITAR FUNCIONÁRIO
     * ============================================================
     */
    public function editar()
    {
        $model = new FuncionarioModel();
        $modelAdm = new AdministradorModel();
        $funEpi = new FunEpi();

        /*
        ============================================================
        ADMINISTRADOR
        ============================================================
        */

        $cpfAdm = session()->get('cpf');

        if (empty($cpfAdm)) {

            return redirect()
                ->to('/login')
                ->with(
                    'erro',
                    'Sessão expirada.'
                );
        }

        $dadosAdm = $modelAdm->find($cpfAdm);

        if (!$dadosAdm) {

            return redirect()
                ->back()
                ->with(
                    'erro',
                    'Administrador não encontrado.'
                );
        }

        /*
        ============================================================
        CPF ORIGINAL
        ============================================================
        */

        $cpfOriginal = $this->formatarCPF(
            $this->request->getPost(
                'CPF_ORIGINAL'
            )
        );

        if (empty($cpfOriginal)) {

            return redirect()
                ->to('/cadastro-funcionario')
                ->with(
                    'erro',
                    'CPF do funcionário não informado.'
                );
        }

        /*
        ============================================================
        VERIFICAR SE FUNCIONÁRIO EXISTE NA EMPRESA
        ============================================================
        */

        $funcionario = $model
            ->where(
                'CPF',
                $cpfOriginal
            )
            ->where(
                'FK_CNPJ_EMPRESA',
                $dadosAdm['FK_CNPJ_EMPRESA']
            )
            ->first();

        if (!$funcionario) {

            return redirect()
                ->to('/cadastro-funcionario')
                ->with(
                    'erro',
                    'Funcionário não encontrado.'
                );
        }

        /*
        ============================================================
        DADOS PARA ATUALIZAÇÃO
        ============================================================
        */

        $dados = [

            'NOME_COMPLETO' =>
                trim(
                    $this->request->getPost(
                        'NOME_COMPLETO'
                    )
                ),

            'DATA_NASCIMENTO' =>
                $this->request->getPost(
                    'DATA_NASCIMENTO'
                ),

            'EMAIL_CORPORATIVO' =>
                trim(
                    $this->request->getPost(
                        'EMAIL_CORPORATIVO'
                    )
                ),

            'TELEFONE' =>
                trim(
                    $this->request->getPost(
                        'TELEFONE'
                    )
                ),

            'UID_RFID' =>
                trim(
                    $this->request->getPost(
                        'UID_RFID'
                    )
                ),

            'FK_ID_SETOR' =>
                $this->request->getPost(
                    'FK_ID_SETOR'
                )
        ];

        /*
        ============================================================
        SENHA NA EDIÇÃO
        ============================================================
        */

        $novaSenha = (string) $this->request->getPost('SENHA');
        $confirmarNovaSenha = (string) $this->request->getPost('CONFIRMAR_SENHA');

        if ($novaSenha !== '') {

            if (strlen($novaSenha) < 6) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'erro',
                        'A nova senha deve ter no mínimo 6 caracteres.'
                    );
            }

            if ($novaSenha !== $confirmarNovaSenha) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'erro',
                        'A nova senha e a confirmação devem ser iguais.'
                    );
            }

            $dados['SENHA'] = password_hash(
                $novaSenha,
                PASSWORD_DEFAULT
            );
        }


        /*
        ============================================================
        ATUALIZAR
        ============================================================
        */

        if (!$model->update($cpfOriginal, $dados)) {

            $erros = $model->errors();

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    !empty($erros)
                        ? implode('<br>', $erros)
                        : 'Não foi possível atualizar o funcionário.'
                );
        }

        /*
        ============================================================
        REMOVER EPIS ANTIGOS
        ============================================================
        */

        $funEpi
            ->where(
                'FK_FUNCIONARIO_CPF',
                $cpfOriginal
            )
            ->delete();

        /*
        ============================================================
        SALVAR NOVOS EPIS
        ============================================================
        */

        $this->salvarEpisFuncionario(
            $cpfOriginal,
            $dadosAdm['FK_CNPJ_EMPRESA']
        );

        /*
        ============================================================
        SUCESSO
        ============================================================
        */

        return redirect()
            ->to('/cadastro-funcionario')
            ->with(
                'sucesso',
                'Funcionário atualizado com sucesso!'
            );
    }


  
public function excluir($cpf)
{
    $model = new FuncionarioModel();
    $modelAdm = new AdministradorModel();

    // ============================================================
    // ADMINISTRADOR LOGADO
    // ============================================================

    $cpfAdm = session()->get('cpf');

    if (empty($cpfAdm)) {
        return redirect()
            ->to('/login')
            ->with('erro', 'Sessão expirada.');
    }

    $dadosAdm = $modelAdm->find($cpfAdm);

    if (!$dadosAdm) {
        return redirect()
            ->to('/login')
            ->with('erro', 'Administrador não encontrado.');
    }

    // ============================================================
    // CPF RECEBIDO
    // ============================================================

    $cpfRecebido = urldecode($cpf);

    // Remove pontos, traços e qualquer outro caractere
    $cpfNumerico = preg_replace('/\D/', '', $cpfRecebido);

    if (strlen($cpfNumerico) !== 11) {
        return redirect()
            ->to('/cadastro-funcionario')
            ->with('erro', 'CPF inválido.');
    }

    // CPF com máscara
    $cpfFormatado =
        substr($cpfNumerico, 0, 3) . '.' .
        substr($cpfNumerico, 3, 3) . '.' .
        substr($cpfNumerico, 6, 3) . '-' .
        substr($cpfNumerico, 9, 2);

    // ============================================================
    // PROCURAR O FUNCIONÁRIO
    //
    // Aceita CPF salvo:
    // 00000000000
    // ou
    // 000.000.000-00
    // ============================================================

    $funcionario = $model
        ->where('FK_CNPJ_EMPRESA', $dadosAdm['FK_CNPJ_EMPRESA'])
        ->groupStart()
            ->where('CPF', $cpfNumerico)
            ->orWhere('CPF', $cpfFormatado)
        ->groupEnd()
        ->first();

    if (!$funcionario) {
        return redirect()
            ->to('/cadastro-funcionario')
            ->with(
                'erro',
                'Funcionário não encontrado.'
            );
    }

    // ============================================================
    // EXCLUIR USANDO O CPF REALMENTE SALVO NO BANCO
    // ============================================================

    $cpfBanco = $funcionario['CPF'];

    if (!$model->delete($cpfBanco)) {

        $erros = $model->errors();

        return redirect()
            ->to('/cadastro-funcionario')
            ->with(
                'erro',
                !empty($erros)
                    ? implode('<br>', $erros)
                    : 'Não foi possível excluir o funcionário.'
            );
    }

    // ============================================================
    // SUCESSO
    // ============================================================

    return redirect()
        ->to('/cadastro-funcionario')
        ->with(
            'sucesso',
            'Funcionário excluído com sucesso!'
        );
}

    
     //* ============================================================
     //* VERIFICAR CPF
     //* ============================================================
    // */
    public function verificarCPF()
    {
        $cpf = $this->formatarCPF(
            $this->request->getPost('CPF')
        );

        $model = new FuncionarioModel();

        $funcionario = $model
            ->where(
                'CPF',
                $cpf
            )
            ->first();

        return $this->response->setJSON([
            'existe' => $funcionario ? true : false
        ]);
    }


    /**
     * ============================================================
     * SALVAR EPIS DO FUNCIONÁRIO
     * ============================================================
     */
   private function salvarEpisFuncionario(
    $cpfFuncionario,
    $cnpjEmpresa
) {
    $funEpi = new FunEpi();
    $modelEpi = new EpiModel();
    $modelAdm = new AdministradorModel();
    $modelEpiAdm = new EpiAdmModel();

    /*
    ============================================================
    RECEBER EPIS
    ============================================================
    */

    $episRecebidos = $this->request->getPost('EPIS');

    if (empty($episRecebidos)) {
        return;
    }

    /*
    ============================================================
    ACEITAR ARRAY DO SELECT NORMAL OU JSON DO CADASTRO
    ============================================================
    */

    if (is_array($episRecebidos)) {
        $epis = $episRecebidos;
    } else {
        $epis = json_decode($episRecebidos, true);
    }

    if (!is_array($epis)) {
        return;
    }

    /*
    ============================================================
    BUSCAR ADMINISTRADORES DA EMPRESA
    ============================================================
    */

    $administradores = $modelAdm
        ->where(
            'FK_CNPJ_EMPRESA',
            $cnpjEmpresa
        )
        ->findAll();

    $cpfsAdministradores = array_column(
        $administradores,
        'CPF'
    );

    if (empty($cpfsAdministradores)) {
        return;
    }

    /*
    ============================================================
    BUSCAR EPIS PERMITIDOS PARA A EMPRESA
    ============================================================
    */

    $episAdm = $modelEpiAdm
        ->whereIn(
            'FK_ADMINISTRADOR_CPF',
            $cpfsAdministradores
        )
        ->findAll();

    $idsEpisPermitidos = array_column(
        $episAdm,
        'FK_EPI_ADM'
    );

    $idsEpisPermitidos = array_map(
        'intval',
        $idsEpisPermitidos
    );

    $idsEpisPermitidos = array_values(
        array_unique(
            $idsEpisPermitidos
        )
    );

    /*
    ============================================================
    EVITAR EPIS REPETIDOS
    ============================================================
    */

    $idsEpisSelecionados = [];

    /*
    ============================================================
    PROCESSAR EPIS RECEBIDOS
    ============================================================
    */

    foreach ($epis as $epi) {

        /*
        O JS pode enviar:

        {
            "id": 1,
            "nome": "Capacete"
        }

        ou:

        1
        */

        if (is_array($epi)) {

            $idEpi = $epi['id'] ?? null;

        } else {

            $idEpi = $epi;
        }

        if (empty($idEpi)) {
            continue;
        }

        $idEpi = (int) $idEpi;

        /*
        ========================================================
        NÃO PERMITIR EPI FORA DA EMPRESA
        ========================================================
        */

        if (
            !in_array(
                $idEpi,
                $idsEpisPermitidos,
                true
            )
        ) {
            continue;
        }

        /*
        ========================================================
        NÃO REPETIR EPI
        ========================================================
        */

        if (
            in_array(
                $idEpi,
                $idsEpisSelecionados,
                true
            )
        ) {
            continue;
        }

        /*
        ========================================================
        VERIFICAR SE O EPI EXISTE
        ========================================================
        */

        $epiExiste = $modelEpi->find($idEpi);

        if (!$epiExiste) {
            continue;
        }

        /*
        ========================================================
        INSERIR EPI
        ========================================================
        */

        $funEpi->insert([
            'FK_FUNCIONARIO_CPF' => $cpfFuncionario,
            'FK_EPI_ID' => $idEpi
        ]);

        /*
        ========================================================
        GUARDAR ID JÁ INSERIDO
        ========================================================
        */

        $idsEpisSelecionados[] = $idEpi;
    }
}


    /**
     * ============================================================
     * FORMATAR CPF
     * ============================================================
     */
    private function formatarCPF($cpf)
    {
        if (empty($cpf)) {
            return '';
        }

        $cpf = preg_replace(
            '/\D/',
            '',
            $cpf
        );

        if (strlen($cpf) !== 11) {
            return '';
        }

        return substr($cpf, 0, 3) . '.' .
               substr($cpf, 3, 3) . '.' .
               substr($cpf, 6, 3) . '-' .
               substr($cpf, 9, 2);
    }


    /**
     * ============================================================
     * VALIDAR CPF
     * ============================================================
     */
    private function validarCPF($cpf)
    {
        $cpf = preg_replace(
            '/\D/',
            '',
            $cpf
        );

        if (strlen($cpf) !== 11) {
            return false;
        }

        /*
        ============================================================
        BLOQUEAR CPFs COM TODOS OS DÍGITOS IGUAIS
        ============================================================
        */

        if (
            preg_match(
                '/^(\d)\1{10}$/',
                $cpf
            )
        ) {
            return false;
        }

        /*
        ============================================================
        PRIMEIRO DÍGITO
        ============================================================
        */

        $soma = 0;

        for ($i = 0; $i < 9; $i++) {

            $soma +=
                (int) $cpf[$i] *
                (10 - $i);
        }

        $resto = ($soma * 10) % 11;

        if ($resto === 10) {
            $resto = 0;
        }

        if (
            $resto !==
            (int) $cpf[9]
        ) {
            return false;
        }

        /*
        ============================================================
        SEGUNDO DÍGITO
        ============================================================
        */

        $soma = 0;

        for ($i = 0; $i < 10; $i++) {

            $soma +=
                (int) $cpf[$i] *
                (11 - $i);
        }

        $resto = ($soma * 10) % 11;

        if ($resto === 10) {
            $resto = 0;
        }

        return (
            $resto ===
            (int) $cpf[10]
        );
    }
}
?>
