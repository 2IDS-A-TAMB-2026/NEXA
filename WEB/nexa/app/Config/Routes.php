<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =====================================================
// PÁGINA INICIAL
// =====================================================

$routes->get('/', 'InstitucionalController::index');


// =====================================================
// ROTAS DO LOGIN ADMINISTRADOR
// =====================================================

$routes->get('/login', 'LoginController::index');

$routes->post(
    '/login/autenticar',
    'LoginController::autenticar'
);

$routes->get('/logout', 'LoginController::logout');


// =====================================================
// ROTAS DO LOGIN FUNCIONÁRIO
// =====================================================

$routes->get(
    '/loginfun',
    'LoginFunController::index'
);

$routes->post(
    '/loginfun/autenticar',
    'LoginFunController::autenticar'
);

$routes->get('/logoutfun', 'LoginFunController::logout');

// =====================================================
// ROTAS DE FUNCIONÁRIO
// =====================================================

$routes->get(
    '/Cadastro_Fun',
    'FuncionarioController::index',
    ['filter' => 'auth']
);
$routes->get('/Cadastro_Fun/novo', 'FuncionarioController::novo');
$routes->post('/Cadastro_Fun/inserir', 'FuncionarioController::inserir');
$routes->post('Cadastro_Fun/editar', 'FuncionarioController::editar');
$routes->get('/Cadastro_Fun/excluir/(:any)', 'FuncionarioController::excluir/$1');


// =====================================================
// ROTAS DO PERFIL ADM
// =====================================================
//$routes->get('/perfil','AdministradorController::index',['filter' => 'auth']);

// =====================================================
// ROTAS DE ADMINISTRADOR
// =====================================================
//esse filtro deu certo
$routes->get(
    '/administrador',
    'AdministradorController::index',
    ['filter' => 'auth']
);

//testando (é por causa dele que o redirecionamento dps de salvar dados ta dando errado)
$routes->get('/sistema/administrador/index', 'AdministradorController::index');

$routes->get('/administrador/novo', 'AdministradorController::novo');
$routes->post('/administrador/inserir', 'AdministradorController::inserir');
$routes->get('/administrador/excluir/(:any)', 'AdministradorController::excluir/$1');

// tentativa de fazer filtro (deu errado)

$routes->get(
    '/administrador/editar/(:any)',
    'AdministradorController::editar/$1',
    ['filter' => 'auth']
);

$routes->post(
    '/administrador/atualizar/(:any)',
    'AdministradorController::atualizar/$1',
    //['filter' => 'auth']
);
// =====================================================
// ROTAS DE EMPRESA
// =====================================================
$routes->get(
    '/empresa',
    'EmpresaController::index',
    ['filter' => 'auth']
);
$routes->get('/empresa/novo', 'EmpresaController::novo');
$routes->post('/empresa/inserir', 'EmpresaController::inserir');
$routes->get('/empresa/editar/(:any)', 'EmpresaController::editar/$1');
$routes->post('/empresa/atualizar/(:any)', 'EmpresaController::atualizar/$1');
$routes->get('/empresa/excluir/(:any)', 'EmpresaController::excluir/$1');


// =====================================================
// ROTAS DE EPI
// =====================================================

$routes->get(
    '/epi',
    'EpiController::index',
    ['filter' => 'auth']
);
$routes->get('/epi/novo', 'EpiController::novo');
$routes->post('/epi/inserir', 'EpiController::inserir');
$routes->get('/epi/editar/(:num)', 'EpiController::editar/$1');
$routes->post('/epi/atualizar/(:num)', 'EpiController::atualizar/$1');
$routes->get('/epi/excluir/(:num)', 'EpiController::excluir/$1');


// =====================================================
// ROTAS DE OCORRÊNCIA
// =====================================================

$routes->get(
    '/history',
    'OcorrenciaController::index',
    ['filter' => 'auth']
);

$routes->get(
    '/ocorrencia/novo',
    'OcorrenciaController::novo'
);

$routes->post(
    '/ocorrencia/inserir',
    'OcorrenciaController::inserir'
);

$routes->get(
    '/ocorrencia/editar/(:num)',
    'OcorrenciaController::editar/$1'
);

$routes->post(
    '/ocorrencia/atualizar/(:num)',
    'OcorrenciaController::atualizar/$1'
);

$routes->get(
    '/ocorrencia/excluir/(:num)',
    'OcorrenciaController::excluir/$1'
);

// =====================================================
// ROTAS DE FUNCIONARIO_OCORRENCIA
// =====================================================

$routes->get('/funocorrencia', 'FunOcorrenciaController::index');
$routes->get('/funocorrencia/novo', 'FunOcorrenciaController::novo');
$routes->post('/funocorrencia/inserir', 'FunOcorrenciaController::inserir');
$routes->get('/funocorrencia/editar/(:num)', 'FunOcorrenciaController::editar/$1');
$routes->post('/funocorrencia/atualizar/(:num)', 'FunOcorrenciaController::atualizar/$1');
$routes->get('/funocorrencia/excluir/(:num)', 'FunOcorrenciaController::excluir/$1');


// =====================================================
// ROTAS DE EMPRESAADM
// =====================================================

$routes->get('/empresaadm', 'EmpresaAdmController::index');
$routes->get('/empresaadm/novo', 'EmpresaAdmController::novo');
$routes->post('/empresaadm/inserir', 'EmpresaAdmController::inserir');
$routes->get('/empresaadm/editar/(:num)', 'EmpresaAdmController::editar/$1');
$routes->post('/empresaadm/atualizar/(:num)', 'EmpresaAdmController::atualizar/$1');
$routes->get('/empresaadm/excluir/(:num)', 'EmpresaAdmController::excluir/$1');


// =====================================================
// ROTAS DE OCORRENCIAEPI
// =====================================================

$routes->get('/ocorrenciaepi', 'OcorrenciaEpiController::index');
$routes->get('/ocorrenciaepi/novo', 'OcorrenciaEpiController::novo');
$routes->post('/ocorrenciaepi/inserir', 'OcorrenciaEpiController::inserir');
$routes->get('/ocorrenciaepi/editar/(:num)', 'OcorrenciaEpiController::editar/$1');
$routes->post('/ocorrenciaepi/atualizar/(:num)', 'OcorrenciaEpiController::atualizar/$1');
$routes->get('/ocorrenciaepi/excluir/(:num)', 'OcorrenciaEpiController::excluir/$1');


// =====================================================
// ROTAS DE EPIADM
// =====================================================

$routes->get('/epiadm', 'EpiAdmController::index');
$routes->get('/epiadm/novo', 'EpiAdmController::novo');
$routes->post('/epiadm/inserir', 'EpiAdmController::inserir');
$routes->get('/epiadm/editar/(:num)', 'EpiAdmController::editar/$1');
$routes->post('/epiadm/atualizar/(:num)', 'EpiAdmController::atualizar/$1');
$routes->get('/epiadm/excluir/(:num)', 'EpiAdmController::excluir/$1');


// =====================================================
// ROTAS DE FUNADM
// =====================================================

$routes->get('/funadm', 'FunAdmController::index');
$routes->get('/funadm/novo', 'FunAdmController::novo');
$routes->post('/funadm/inserir', 'FunAdmController::inserir');
$routes->get('/funadm/editar/(:num)', 'FunAdmController::editar/$1');
$routes->post('/funadm/atualizar/(:num)', 'FunAdmController::atualizar/$1');
$routes->get('/funadm/excluir/(:num)', 'FunAdmController::excluir/$1');


// =====================================================
// ROTAS DE CAMERA
// =====================================================

$routes->get(
    '/Camera',
    'CameraController::index',
    ['filter' => 'auth']
);
$routes->get('Camera', 'CameraController::index');
$routes->post('Camera/inserir', 'CameraController::inserir');
$routes->post('Camera/atualizar/(:any)', 'CameraController::atualizar/$1');
$routes->get('Camera/excluir/(:any)', 'CameraController::excluir/$1');

//================================================
//         CHAT QUE DEU
//================================================

$routes->get('/login', 'LoginController::index');

$routes->post('/login/autenticar', 'LoginController::autenticar');

$routes->get('/logout', 'LoginController::logout');

$routes->get(
    '/dashboard',
    'DashboardController::index',
    ['filter' => 'auth']
);





$routes->get(
    '/dashboard-cam',
    'CameraController::index',
    ['filter' => 'auth']
);
$routes->get(
    '/ocorrencia',
    'OcorrenciaController::index',
    ['filter' => 'auth']
);
$routes->get(
    '/epis',
    'EpiController::index',
    ['filter' => 'auth']
);
$routes->get(
    '/camera',
    'CameraController::index',
    ['filter' => 'auth']
);

$routes->get(
    '/perfil',
    'PerfilController::index',
    ['filter' => 'auth']
);

$routes->get(
    '/cadastro-funcionario',
    'CadastroFunController::index',
    ['filter' => 'auth']
);
$routes->post('/cadastro-funcionario/salvar', 'CadastroFunController::salvar');




// =====================================================
// ROTAS DE SETOR
// =====================================================

// SETORES

$routes->get(
    'setor',
    'SetorController::index',
    ['filter' => 'auth']
);


$routes->get('/setor/novo', 'SetorController::novo');
$routes->post('/setor/inserir', 'SetorController::inserir');
$routes->get('/setor/editar/(:num)', 'SetorController::editar/$1');
$routes->post('/setor/atualizar/(:num)', 'SetorController::atualizar/$1');
$routes->get('/setor/excluir/(:num)', 'SetorController::excluir/$1');

$routes->post(
    'setor/atualizar/(:num)',
    'SetorController::atualizar/$1'
);



// =====================================================
// ROTAS ANALISE IA
// =====================================================
$routes->get(
    'camera_analise',
    'AnaliseEpiController::index',
    ['filter' => 'authfun']
);

$routes->post(
    'camera_analise/analisar',
    'AnaliseEpiController::analisar'
);

// DASHBOARD FUNCIONÁRIO
$routes->get(
    '/logoutfun',
    'LoginFunController::logout'
);


// Dashboard Funcionário
$routes->get(
    '/dashboardfun',
    'DashboardFunController::index',
    ['filter' => 'authfun']
);

// ==============================
// PERFIL FUNCIONÁRIO
// ==============================

$routes->get(
    '/perfilfun',
    'PerfilFunController::index',
    ['filter' => 'authfun']
);

$routes->post(
    '/perfilfun/atualizar',
    'PerfilFunController::atualizar'
);



/*
|--------------------------------------------------------------------------
| DASHBOARD DE CÂMERAS
|--------------------------------------------------------------------------
*/
$routes->get('/dashboard_camera', 'DashboardCameraController::index');



// ROTAS DE RECUPERAR E REDEFINIR SENHA


$routes->get(
    'recuperar',
    'RecuperarSenhaController::index'
);

$routes->post(
    'recuperar/enviar',
    'RecuperarSenhaController::enviar'
);

$routes->get(
    '/nova-senha/(:any)',
    'RecuperarSenhaController::formNovaSenha/$1'
);

$routes->post(
    '/salvar-nova-senha',
    'RecuperarSenhaController::salvarNovaSenha'
);