<?php

namespace App\Controllers;
use App\Models\FuncionarioModel;
use App\Models\OcorrenciaModel;

class DashboardFunController extends BaseController
{
    public function index()
    {
        if (!session()->get('logado_fun')) {
            return redirect()->to('/loginfun');
        }

        $cpf = session()->get('cpf_fun');

        $funcionarioModel = new FuncionarioModel();
        $ocorrenciaModel = new OcorrenciaModel();

       $funcionario = $funcionarioModel->find($cpf);
$ocorrencias = $ocorrenciaModel->getByFuncionario($cpf);

/*
 * ==========================================================
 * EPIs OBRIGATÓRIOS DO FUNCIONÁRIO
 * ==========================================================
 */

$db = \Config\Database::connect();

$episObrigatorios = $db->table('FUN_EPI fe')
    ->select('e.NOME_EPI')
    ->join(
        'EPI e',
        'e.ID = fe.FK_EPI_ID',
        'inner'
    )
    ->where(
        'fe.FK_FUNCIONARIO_CPF',
        $cpf
    )
    ->get()
    ->getResultArray();

$episObrigatoriosNormalizados = [];

foreach ($episObrigatorios as $epi) {

    if (!empty($epi['NOME_EPI'])) {

        $episObrigatoriosNormalizados[] =
            $this->normalizarEpi($epi['NOME_EPI']);
    }
}


/*
 * ==========================================================
 * FILTRAR EPIs DETECTADOS DAS OCORRÊNCIAS
 * ==========================================================
 */

foreach ($ocorrencias as &$ocorrencia) {

    $detectados =
        $ocorrencia['EPIS_DETECTADOS'] ?? '';

    if (
        empty($detectados) ||
        strtolower(trim($detectados)) === 'nenhum'
    ) {
        $ocorrencia['EPIS_DETECTADOS'] = 'Nenhum';
        continue;
    }

    $listaDetectados =
        array_map(
            'trim',
            explode(',', $detectados)
        );

    $detectadosObrigatorios = [];

    foreach ($listaDetectados as $epiDetectado) {

        $normalizado =
            $this->normalizarEpi($epiDetectado);

        if (
            in_array(
                $normalizado,
                $episObrigatoriosNormalizados,
                true
            )
        ) {

            $detectadosObrigatorios[] =
                $epiDetectado;
        }
    }

    $ocorrencia['EPIS_DETECTADOS'] =
        empty($detectadosObrigatorios)
            ? 'Nenhum'
            : implode(
                ', ',
                array_unique($detectadosObrigatorios)
            );
}

unset($ocorrencia);

        return view('sistema/DashboardFun/dashboardfun', [
            'funcionario' => $funcionario,
            'ocorrencias' => $ocorrencias
        ]);
    }

    private function normalizarEpi($nome)
{
    $nome = trim($nome);

    $nome = iconv(
        'UTF-8',
        'ASCII//TRANSLIT//IGNORE',
        $nome
    );

    $nome = strtolower($nome);

    $nome = preg_replace(
        '/\s+/',
        ' ',
        $nome
    );

    switch ($nome) {

        case 'hard hat':
        case 'helmet':
        case 'capacete':
            return 'capacete';

        case 'gloves':
        case 'glove':
        case 'luvas':
        case 'luva':
            return 'luvas';

        case 'glasses':
        case 'protective glasses':
        case 'safety glasses':
        case 'oculos':
        case 'oculos de protecao':
            return 'oculos de protecao';

        case 'safety shoes':
        case 'boots':
        case 'boot':
        case 'botas':
        case 'botas de seguranca':
        case 'sapatos de seguranca':
            return 'botas de seguranca';

        case 'mask':
        case 'masks':
        case 'mascara':
            return 'mascara';

        case 'safety vest':
        case 'vest':
        case 'colete':
            return 'colete';

        case 'ear muffs':
        case 'ear protection':
        case 'protetor auricular':
            return 'protetor auricular';

        default:
            return $nome;
    }
}
}