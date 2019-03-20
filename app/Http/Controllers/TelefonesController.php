<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TelefonesController extends Controller
{
    
    public function store(Request $request, \App\Pessoa $pessoa) {

        // Re-validamos os dados
        $this->validar($request)->validate();

        // Caso os dados sejam válidos:

        // Criamos o telefone
        $telefone = new \App\Telefone($request->all());

        // Salvamos o telefone diretamente para a pessoa no banco
        return $pessoa->telefones()->save($telefone);
    }

    public function validar($data) {

        // Regras para a validação do telefone
        $rules = [
            'ddd' => 'required|integer|digits:2',
            'numero' => 'required|string|digits_between:8,10',
        ];

        // Mensagens de erro personalizadas
        $messages = [
            'ddd.required' => 'O DDD é necessário.',
            'ddd.integer' => 'O DDD precisa ser um número.',
            'ddd.digits' => 'O DDD precisa possuir 2 dígitos.',
            
            'numero.required' => 'O número é necessário.',
            'numero.string' => 'O número precisa ser especificado.',
            'numero.digits_between' => 'O número precisa ter entre 8 e 10 dígitos.',
        ];

        // Retornamos o validador
        return Validator::make($data->all(), $rules, $messages);
    }

}
