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
$routes->post(
    '/Cadastro_Fun/inserir',
    'CadastroFunController::inserir'
);
$routes->post(
    '/Cadastro_Fun/editar',
    'CadastroFunController::editar'
);

$routes->get(
    '/Cadastro_Fun/excluir/(:any)',
    'CadastroFunController::excluir/$1'
);

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

//testando
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


// =====================================================
// ROTAS DE CAM ADM
// =====================================================

$routes->get('/cam-adm', 'CamAdmController::index');

$routes->post('/cam-adm/inserir', 'CamAdmController::inserir');

$routes->post('/cam-adm/atualizar/(:num)', 'CamAdmController::atualizar/$1');

$routes->get('/cam-adm/excluir/(:num)', 'CamAdmController::excluir/$1');

$routes->get('/cam-adm/editar/(:num)', 'CamAdmController::editar/$1');




//editar fun
$routes->post(
'/Cadastro_Fun/editar/(:any)',
'CadastroFunController::editar/$1'
);

$routes->post(
    'Cadastro_Fun/verificarCPF',
    'CadastroFunController::verificarCPF'
);




//===================================================
// TESTE DO FLUTTER ALTAS CHANCES DE ERRO
//===================================================


// ============================================================
// API NEXA - MOBILE
// ============================================================
$routes->options('api/login', function () {
    return service('response')
        ->setStatusCode(200);
});
// ------------------------------------------------------------
// AUTENTICAÇÃO
// ------------------------------------------------------------

$routes->post(
    'api/login',
    'api\AuthController::login',
    ['filter' => 'cors']
);$routes->post('api/logout', 'api\AuthController::logout');


// ------------------------------------------------------------
// PERFIL DO FUNCIONÁRIO
// ------------------------------------------------------------
$routes->get(
    'api/perfil/(:segment)',
    'api\PerfilController::show/$1',
    ['filter' => 'cors']
);

$routes->put(
    'api/perfil/(:segment)',
    'api\PerfilController::update/$1',
    ['filter' => 'cors']
);

$routes->put(
    'api/perfil/(:segment)/senha',
    'api\PerfilController::senha/$1',
    ['filter' => 'cors']
);

// ------------------------------------------------------------
// DASHBOARD
// ------------------------------------------------------------

$routes->get(
    'api/dashboard/(:segment)',
    'api\DashboardController::index/$1',
    ['filter' => 'cors']
);

// ------------------------------------------------------------
// EPIs
// ------------------------------------------------------------

// EPIs pertencentes ao funcionário
$routes->get(
    'api/funcionarios/(:segment)/epis',
    'api\EpiController::funcionario/$1'
);

// Histórico de verificações de EPI
$routes->get(
    'api/epis/verificacoes/(:segment)',
    'api\EpiController::verificacoes/$1'
);

// EPI específico
$routes->get(
    'api/epis/(:num)',
    'api\EpiController::show/$1'
);


// ------------------------------------------------------------
// CÂMERAS
// ------------------------------------------------------------

// Todas as câmeras
$routes->get(
    'api/cameras',
    'api\CameraController::index'
);

// Câmera específica
$routes->get(
    'api/cameras/(:num)',
    'api\CameraController::show/$1'
);

// Última análise registrada da câmera
$routes->post(
    'api/cameras/(:num)/analisar',
    'api\CameraController::analisar/$1',
    ['filter' => 'cors']
);


// ------------------------------------------------------------
// OCORRÊNCIAS
// ------------------------------------------------------------

// Ocorrências de um funcionário/
$routes->get(
    'api/ocorrencias/funcionario/(:segment)',
    'api\OcorrenciaController::funcionario/$1'
);

// Ocorrência específica
$routes->get(
    'api/ocorrencias/(:num)',
    'api\OcorrenciaController::show/$1'
);


$routes->options('api/(:any)', function () {
    return service('response')
        ->setStatusCode(200);
});



// API RFID

$routes->post(
    'api/rfid',
    'api\RfidController::index'
);