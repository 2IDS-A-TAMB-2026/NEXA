<?php

namespace App\Models;

use CodeIgniter\Model;

class FuncionarioModel extends Model
{
    protected $table = 'FUNCIONARIO';

    protected $primaryKey = 'CPF';

    // 🌟 ESSA LINHA É CRUCIAL: Diz ao CodeIgniter que o CPF NÃO é gerado automaticamente pelo banco!
    protected $useAutoIncrement = false;

    protected $allowedFields = [
        'CPF',
        'NOME_COMPLETO',
        'DATA_NASCIMENTO',
        'EMAIL_CORPORATIVO',
        'TELEFONE',
        'SENHA',
        'UID_RFID',
        'FK_CNPJ_EMPRESA',
        'FK_ID_SETOR'
    ];
    
    protected $returnType = 'array';

    // 🌟 REGRAS DE VALIDAÇÃO (No mesmo padrão do seu EpiModel)
    protected $validationRules = [
        'CPF' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O CPF do funcionário é obrigatório.'
            ]
        ],
        'NOME_COMPLETO' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'O nome completo é obrigatório.',
                'min_length' => 'O nome deve ter pelo menos 3 caracteres.'
            ]
        ],
        'EMAIL_CORPORATIVO' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'O e-mail corporativo é obrigatório.',
                'valid_email' => 'Por favor, insira um e-mail válido.'
            ]
        ],
        'FK_CNPJ_EMPRESA' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O CNPJ da empresa é obrigatório.'
            ]
        ],
        'FK_ID_SETOR' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O ID do setor é obrigatório.'
            ]
        ]
    ];

    // FUNÇÃO DE LOGIN
    public function login($email, $senha)
    {
        $funcionario = $this->where('EMAIL_CORPORATIVO', $email)->first();

        if ($funcionario && password_verify($senha, $funcionario['SENHA'])) {
            return $funcionario;
        }

        return null;
    }
}