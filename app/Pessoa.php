<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    // Para usar o SoftDeletes
    use SoftDeletes;

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

    // Data considerada pelo SoftDeletes
    protected $dates = ['deleted_at'];
}
