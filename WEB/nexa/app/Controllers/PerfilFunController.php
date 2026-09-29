<?php

namespace App\Controllers;

use App\Models\FuncionarioModel;
use App\Models\FunEpi;
use App\Models\EpiModel;

class PerfilFunController extends BaseController
{
    // =========================================================
    // PÁGINA DE PERFIL
    // =========================================================

    public function index()
    {
        if (!session()->get('logado_fun')) {
            return redirect()->to('/loginfun');
        }

        $funcionarioModel = new FuncionarioModel();
        $funEpiModel = new FunEpi();
        $epiModel = new EpiModel();

        $cpf = session()->get('cpf_fun');

        $funcionario = $funcionarioModel->find($cpf);

        if (!$funcionario) {
            return redirect()->to('/loginfun');
        }

        // =====================================================
        // BUSCAR EPIs DO FUNCIONÁRIO
        // =====================================================

        $vinculos = $funEpiModel
            ->where('FK_FUNCIONARIO_CPF', $cpf)
            ->findAll();

        $epis = [];

        foreach ($vinculos as $vinculo) {

            $epi = $epiModel->find($vinculo['FK_EPI_ID']);

            if ($epi !== null) {
                $epis[] = $epi;
            }
        }

        return view('/sistema/PerfilFun/perfilfun', [
            'funcionario' => $funcionario,
            'epis' => $epis
        ]);
    }


    // =========================================================
    // ATUALIZAR PERFIL
    // =========================================================

    public function atualizar()
    {
        if (!session()->get('logado_fun')) {
            return redirect()->to('/loginfun');
        }

        $model = new FuncionarioModel();

        $cpf = session()->get('cpf_fun');

        $funcionario = $model->find($cpf);

        if (!$funcionario) {

            return redirect()->to('/perfilfun')
                ->with('erroPerfil', 'Funcionário não encontrado.');
        }


        // =====================================================
        // DADOS RECEBIDOS
        // =====================================================

        $nome = trim((string) $this->request->getPost('nome'));

        $email = trim((string) $this->request->getPost('email'));

        $telefone = trim((string) $this->request->getPost('telefone'));

        $senhaAtual = (string) $this->request->getPost('senhaAtual');

        $novaSenha = (string) $this->request->getPost('novaSenha');

        $confirmarSenha = (string) $this->request->getPost('confirmarSenha');


        // =====================================================
        // VALIDAÇÃO DO NOME
        // =====================================================

        if ($nome === '') {

            return redirect()->to('/perfilfun')
                ->withInput()
                ->with(
                    'erroPerfil',
                    'Digite seu nome.'
                );
        }

        if (mb_strlen($nome) < 3) {

            return redirect()->to('/perfilfun')
                ->withInput()
                ->with(
                    'erroPerfil',
                    'O nome deve ter pelo menos 3 caracteres.'
                );
        }

        // Não permite números nem caracteres especiais
        if (!preg_match('/^[\p{L}\s]+$/u', $nome)) {

            return redirect()->to('/perfilfun')
                ->withInput()
                ->with(
                    'erroPerfil',
                    'O nome deve conter somente letras e espaços.'
                );
        }


        // =====================================================
        // VALIDAÇÃO DO E-MAIL
        // =====================================================

        if ($email === '') {

            return redirect()->to('/perfilfun')
                ->withInput()
                ->with(
                    'erroPerfil',
                    'Digite seu e-mail.'
                );
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return redirect()->to('/perfilfun')
                ->withInput()
                ->with(
                    'erroPerfil',
                    'Digite um e-mail válido.'
                );
        }


        // =====================================================
        // VALIDAÇÃO DO TELEFONE
        // =====================================================

        if ($telefone === '') {

            return redirect()->to('/perfilfun')
                ->withInput()
                ->with(
                    'erroPerfil',
                    'Digite seu telefone.'
                );
        }


        // =====================================================
        // VERIFICA SE ESTÁ ALTERANDO A SENHA
        // =====================================================

        $alterandoSenha =
            ($novaSenha !== '' || $confirmarSenha !== '');


        // =====================================================
        // VALIDAÇÃO DA SENHA
        // =====================================================

        if ($alterandoSenha) {

            // -------------------------------------------------
            // SENHA ATUAL OBRIGATÓRIA
            // -------------------------------------------------

            if ($senhaAtual === '') {

                return redirect()->to('/perfilfun')
                    ->withInput()
                    ->with(
                        'erroSenhaAtual',
                        'Digite sua senha atual para alterar a senha.'
                    );
            }


            // -------------------------------------------------
            // VERIFICAR SENHA ATUAL
            // -------------------------------------------------

            $senhaValida = false;

            /*
             * Primeiro tenta verificar senha com password_hash().
             */
            if (!empty($funcionario['SENHA'])) {

                $senhaValida = password_verify(
                    $senhaAtual,
                    $funcionario['SENHA']
                );
            }


            /*
             * Compatibilidade com senhas antigas que eventualmente
             * estejam salvas como texto no banco.
             *
             * Quando uma nova senha for criada, ela será salva
             * usando password_hash().
             */
            if (
                !$senhaValida &&
                !empty($funcionario['SENHA']) &&
                hash_equals(
                    (string) $funcionario['SENHA'],
                    $senhaAtual
                )
            ) {

                $senhaValida = true;
            }


            // -------------------------------------------------
            // SENHA ATUAL INCORRETA
            // -------------------------------------------------

            if (!$senhaValida) {

                return redirect()->to('/perfilfun')
                    ->withInput()
                    ->with(
                        'erroSenhaAtual',
                        'A senha atual está incorreta.'
                    );
            }


            // -------------------------------------------------
            // NOVA SENHA - MÍNIMO 6
            // -------------------------------------------------

            if (strlen($novaSenha) < 6) {

                return redirect()->to('/perfilfun')
                    ->withInput()
                    ->with(
                        'erroNovaSenha',
                        'A nova senha deve ter no mínimo 6 caracteres.'
                    );
            }


            // -------------------------------------------------
            // CONFIRMAR SENHA
            // -------------------------------------------------

            if ($novaSenha !== $confirmarSenha) {

                return redirect()->to('/perfilfun')
                    ->withInput()
                    ->with(
                        'erroConfirmarSenha',
                        'As senhas não coincidem.'
                    );
            }
        }


        // =====================================================
        // DADOS QUE SERÃO ATUALIZADOS
        // =====================================================

        $dados = [

            'NOME_COMPLETO' => $nome,

            'EMAIL_CORPORATIVO' => $email,

            'TELEFONE' => $telefone
        ];


        // =====================================================
        // SALVAR NOVA SENHA
        // =====================================================

        if ($alterandoSenha) {

            $dados['SENHA'] = password_hash(
                $novaSenha,
                PASSWORD_DEFAULT
            );
        }


        // =====================================================
        // ATUALIZAR NO BANCO
        // =====================================================

        if (!$model->update($cpf, $dados)) {

            return redirect()->to('/perfilfun')
                ->withInput()
                ->with(
                    'erroPerfil',
                    'Não foi possível atualizar seus dados.'
                );
        }


        // =====================================================
        // ATUALIZAR DADOS DA SESSÃO
        // =====================================================

        session()->set([

            'nome_fun' => $nome,

            'email_fun' => $email

        ]);


        // =====================================================
        // SUCESSO
        // =====================================================

        return redirect()->to('/perfilfun')
            ->with(
                'sucesso',
                'Seus dados foram atualizados com sucesso.'
            );
    }
}