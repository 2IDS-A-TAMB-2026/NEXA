<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'ADMINISTRADOR';

    protected $primaryKey = 'CPF';

    protected $allowedFields = [
        'CPF',
        'EMAIL_CORPORATIVO',
        'SENHA'
    ];

    protected $returnType = 'array';

    public function verificarLogin($email, $senha)
    {
        return $this->where('EMAIL_CORPORATIVO', $email)
                    ->where('SENHA', $senha)
                    ->first();
    }
}