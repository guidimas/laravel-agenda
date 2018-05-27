<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{

    // Campos que podem ser 'bindados'
    protected $fillable = [
        'nome',
    ];

    // Lado 1 : N -> 1 Pessoa tem N Telefones.
    public function telefones() {
        return $this->hasMany('App\Telefone', 'pessoa_id');
    }

    // Tabela do banco de dados
    protected $table = 'pessoas';

}
