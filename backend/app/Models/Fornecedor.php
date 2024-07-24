<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'fornecedores';

    protected $fillable = [
        'cpf_cnpj',
        'nome_fantasia',
        'razao_social',
        'email',
        'telefone',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'estado'
      ];

}
