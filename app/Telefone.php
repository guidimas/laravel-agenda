<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telefone extends Model
{
    // Para usar o SoftDeletes
    use SoftDeletes;
    
    // Campos que podem ser 'bindados'
    protected $fillable = [
        'ddd',
        'numero',
    ];

    // Lado N : 1 -> N Telefones pertencem à 1 Pessoa.
    public function pessoa() {
        return $this->belongsTo('App\Pessoa', 'pessoa_id');
    }

    // Tabela no banco de dados
    protected $table = 'telefones';

    // Data considerada pelo SoftDeletes
    protected $dates = ['deleted_at'];
}
