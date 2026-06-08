<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginFunModel extends Model
{
    protected $table = 'FUNCIONARIO';

    protected $primaryKey = 'CPF';

    protected $returnType = 'array';

    protected $allowedFields = [
        'CPF',
        'NOME_COMPLETO',
        'EMAIL_CORPORATIVO',
        'SENHA'
    ];

    public function verificarLogin($email)
    {
        return $this
            ->where('EMAIL_CORPORATIVO', $email)
            ->first();
    }
}