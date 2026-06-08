<?php

namespace App\Models;

use CodeIgniter\Model;

class EpiModel extends Model
{
    protected $table = 'EPI';

    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'NOME_EPI',
        'IMAGEM_EPI',
        'DESCRICAO_EPI',
        'FK_CPF_FUNCIONARIO'
    ];

    protected $returnType = 'array';

    protected $validationRules = [
    'NOME_EPI' => [
        'rules' => 'required|min_length[3]',
        'errors' => [
            'required' => 'O nome do EPI é obrigatório.',
            'min_length' => 'O nome deve ter pelo menos 3 caracteres.'
        ]
    ],

    'DESCRICAO_EPI' => [
        'rules' => 'required|min_length[5]',
        'errors' => [
            'required' => 'A descrição é obrigatória.',
            'min_length' => 'A descrição deve ter pelo menos 5 caracteres.'
        ]
    ],

    'FK_CPF_FUNCIONARIO' => [
        'rules' => 'required',
        'errors' => [
            'required' => 'Selecione um funcionário.'
        ]
    ]
];
}

