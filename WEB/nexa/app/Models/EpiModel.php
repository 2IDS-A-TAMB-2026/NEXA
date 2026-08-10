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
        //'FK_CPF_FUNCIONARIO'
    ];

    protected $returnType = 'array';

   protected $validationRules = [

    'NOME_EPI' => [
        'rules' => 'required',
        'errors' => [
            'required' => 'O nome do EPI é obrigatório.'
        ]
    ],

    'DESCRICAO_EPI' => [
        'rules' => 'required',
        'errors' => [
            'required' => 'A descrição é obrigatória.'
        ]
    ]

];
}

