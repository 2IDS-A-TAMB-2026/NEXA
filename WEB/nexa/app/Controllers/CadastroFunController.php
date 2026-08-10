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

    public function index()
    {

        $model = new FuncionarioModel();
        $modelAdm = new AdministradorModel();
        $modelSetor = new SetorModel();
        $funEpiModel = new FunEpi();
        $modelEpi = new EpiModel();


        $dados_adm = $modelAdm->find(
            session()->get('cpf')
        );


        /*
        ======================================
        BUSCAR FUNCIONÁRIOS
        ======================================
        */


        $dados['funcionarios'] = $model
            ->where(
                'FK_CNPJ_EMPRESA',
                $dados_adm['FK_CNPJ_EMPRESA']
            )
            ->findAll();



        /*
        ======================================
        BUSCAR EPIS DO FUNCIONÁRIO
        ======================================
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



                $epi = $modelEpi->find(
                    $epiFun['FK_EPI_ID']
                );



                if($epi){


                    $funcionario['EPIS'][] = [

                        'id' =>
                        $epi['ID'],


                        'nome' =>
                        $epi['NOME_EPI']

                    ];


                }


            }


        }



        /*
        ======================================
        SETORES
        ======================================
        */


        $dados['setores'] = $modelSetor
            ->where(
                'FK_CNPJ_EMPRESA',
                $dados_adm['FK_CNPJ_EMPRESA']
            )
            ->findAll();



        /*
        ======================================
        EPIS DISPONÍVEIS DO ADMINISTRADOR
        ======================================
        */


        $modelEpiAdm = new EpiAdmModel();



        $episAdm = $modelEpiAdm
            ->where(
                'FK_ADMINISTRADOR_CPF',
                session()->get('cpf')
            )
            ->findAll();



        $ids = array_column(
            $episAdm,
            'FK_EPI_ADM'
        );



        if(!empty($ids)){


            $dados['epis'] =
                $modelEpi
                ->whereIn(
                    'ID',
                    $ids
                )
                ->findAll();



        }else{


            $dados['epis'] = [];


        }



        return view(
            'sistema/Cadastro_Fun/index',
            $dados
        );


    }
    public function inserir()
{

    $model = new FuncionarioModel();
    $modelAdm = new AdministradorModel();


    $dados_adm = $modelAdm->find(
        session()->get('cpf')
    );



    /*
    ======================================
    LIMPAR CPF
    ======================================
    */


    $cpf = preg_replace(
        '/\D/',
        '',
        $this->request->getPost('CPF')
    );



    /*
    ======================================
    CADASTRAR FUNCIONÁRIO
    ======================================
    */


    $dados = [


        'CPF' =>
            $cpf,


        'NOME_COMPLETO' =>
            $this->request->getPost('NOME_COMPLETO'),



        'DATA_NASCIMENTO' =>
            $this->request->getPost('DATA_NASCIMENTO'),



        'EMAIL_CORPORATIVO' =>
            $this->request->getPost('EMAIL_CORPORATIVO'),



        'TELEFONE' =>
            $this->request->getPost('TELEFONE'),



        'UID_RFID' =>
            $this->request->getPost('UID_RFID'),



        'FK_CNPJ_EMPRESA' =>
            $dados_adm['FK_CNPJ_EMPRESA'],



        'FK_ID_SETOR' =>
            $this->request->getPost('FK_ID_SETOR'),



        'SENHA' =>
            password_hash(

                $this->request->getPost('SENHA'),

                PASSWORD_DEFAULT

            )


    ];


// ======================================
// VERIFICAR CPF DUPLICADO
// ======================================
// ======================================
// VALIDAR CPF VAZIO
// ======================================

if(empty($cpf)){

    return redirect()
        ->back()
        ->withInput()
        ->with('erro','Digite um CPF.');

}


// ======================================
// VALIDAR CPF REAL
// ======================================
if(!$this->validarCPF($cpf)){
    return redirect()
        ->back()
        ->withInput()
        ->with('erro','CPF inválido.');

}


// ======================================
// VERIFICAR CPF DUPLICADO
// ======================================

$cpfExistente = $model
    ->where('CPF', $cpf)
    ->first();


if($cpfExistente){

    return redirect()
        ->back()
        ->withInput()
        ->with('erro','Este CPF já está cadastrado.');

}

if(!$model->insert($dados)){


    return redirect()
        ->back()
        ->withInput()
        ->with(
            'erro',
            implode(
                '<br>',
                $model->errors()
            )
        );


}


    


    /*
    ======================================
    SALVAR EPIS DO FUNCIONÁRIO
    ======================================
    */


    $funEpi = new FunEpi();


$episJson = $this->request->getPost('EPIS');

$epis = json_decode($episJson, true);


if(!is_array($epis)){
    $epis = [];
}



    if(!empty($epis)){



        foreach($epis as $epi){



            /*
            O JS envia:
            [
              {
                id:1,
                nome:"Capacete"
              }
            ]

            */


            $idEpi = is_array($epi)

                ? $epi['id']

                : $epi;




            $funEpi->insert([



                'FK_FUNCIONARIO_CPF' =>

                    $cpf,



                'FK_EPI_ID' =>

                    $idEpi



            ]);



        }



    }




    return redirect()
        ->to('/cadastro-funcionario');

}

public function editar()
{

    $model = new FuncionarioModel();
    $funEpi = new FunEpi();



    /*
    ======================================
    CPF ORIGINAL
    ======================================
    */


    $cpfOriginal = preg_replace(
        '/\D/',
        '',
        $this->request->getPost('CPF_ORIGINAL')
    );


if(empty($cpfOriginal)){

    return redirect()
        ->to('/cadastro-funcionario')
        ->with(
            'erro',
            'CPF do funcionário não informado.'
        );

}
    /*
    ======================================
    ATUALIZAR FUNCIONÁRIO
    ======================================
    */


    $dados = [


        'NOME_COMPLETO' =>
            $this->request->getPost('NOME_COMPLETO'),



        'DATA_NASCIMENTO' =>
            $this->request->getPost('DATA_NASCIMENTO'),



        'EMAIL_CORPORATIVO' =>
            $this->request->getPost('EMAIL_CORPORATIVO'),



        'TELEFONE' =>
            $this->request->getPost('TELEFONE'),



        'UID_RFID' =>
            $this->request->getPost('UID_RFID'),



        'FK_ID_SETOR' =>
            $this->request->getPost('FK_ID_SETOR')


    ];




    if(!$model->update($cpfOriginal,$dados)){


        dd(
            $model->errors()
        );


    }





    /*
    ======================================
    REMOVER EPIS ANTIGOS
    ======================================
    */


    $funEpi
        ->where(
            'FK_FUNCIONARIO_CPF',
            $cpfOriginal
        )
        ->delete();





    /*
    ======================================
    INSERIR NOVOS EPIS
    ======================================
    */


    $epis = json_decode(

        $this->request->getPost('EPIS'),

        true

    );




    if(!empty($epis)){



        foreach($epis as $epi){



            $idEpi = is_array($epi)

                ? $epi['id']

                : $epi;




            $funEpi->insert([


                'FK_FUNCIONARIO_CPF' =>

                    $cpfOriginal,



                'FK_EPI_ID' =>

                    $idEpi


            ]);



        }


    }



    return redirect()
        ->to('/cadastro-funcionario');


}
public function excluir($cpf)
{

    $cpf = preg_replace(
    '/\D/',
        '',
        $cpf
    );



    $model = new FuncionarioModel();
    $funEpi = new FunEpi();



    /*
    ======================================
    REMOVE EPIS VINCULADOS
    ======================================
    */


    $funEpi
        ->where(
            'FK_FUNCIONARIO_CPF',
            $cpf
        )
        ->delete();




    /*
    ======================================
    REMOVE FUNCIONÁRIO
    ======================================
    */


    $model->delete($cpf);



    return redirect()
        ->to('/cadastro-funcionario');


}

public function verificarCPF()
{

   $cpf = preg_replace(
    '/\D/',
        '',
        $this->request->getPost('CPF')
    );


    $model = new FuncionarioModel();


    $funcionario = $model
        ->where('CPF',$cpf)
        ->first();


    if($funcionario){

        return $this->response->setJSON([
            'existe'=>true
        ]);

    }


    return $this->response->setJSON([
        'existe'=>false
    ]);

}
private function validarCPF($cpf)
{
    if(strlen($cpf) != 11)
        return false;


    // bloqueia 00000000000,11111111111...
if(preg_match('/(\d)\1{10}/', $cpf))
{
    return false;
}


    $soma = 0;

    for($i=0;$i<9;$i++){

        $soma += $cpf[$i] * (10-$i);

    }


    $resto = ($soma * 10) % 11;

    if($resto == 10)
        $resto = 0;


    if($resto != $cpf[9])
        return false;



    $soma = 0;


    for($i=0;$i<10;$i++){

        $soma += $cpf[$i] * (11-$i);

    }


    $resto = ($soma * 10) % 11;


    if($resto == 10)
        $resto = 0;


    return $resto == $cpf[10];
}
}