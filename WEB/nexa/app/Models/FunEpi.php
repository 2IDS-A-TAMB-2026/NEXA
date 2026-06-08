<?php
//CRIAR TABELA FUNCIONARIO/EPI NO BCD
namespace App\Models;
use CodeIgniter\Model;

class FunEpiModel extends Model
{
    protected $table = 'FUN_EPI';//MUDAR

    protected $primaryKey = 'ID_FUN_EPI';

    protected $allowedFields = [
        'FK_EPI_ID',
        'FK_FUNCI_CPF'
    ];

    protected $returnType = 'array';
}
?>