<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    
    // Campos que podem ser bindados
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

}
