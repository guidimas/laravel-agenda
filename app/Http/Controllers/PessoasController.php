<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PessoasController extends Controller
{
    // Injecao de dependencias
    private $telefonesController;

    public function __construct(TelefonesController $telefonesController) {
        
        // Injetamos a TelefonesController
        $this->telefonesController = $telefonesController;
        
    }

    // GET /
    public function index() {
        // Lista todas as pessoas
        $listaPessoas = \App\Pessoa::all();
        // Retorna a view com os dados
        return view('pessoas.index', ['listaPessoas' => $listaPessoas]);
    }

    // GET /create
    public function create() {
        return view('pessoas.create');
    }

    // POST /store
    public function store(Request $request) {
        // Salvamos o contato no banco de dados
        $pessoa = \App\Pessoa::create($request->all());
        
        // Se houver ddd e numero do telefone
        if ($request->has('ddd') && $request->has('numero')) {
            
            // Criamos o telefone
            $telefone = new \App\Telefone();
            $telefone->pessoa_id = $pessoa->id;
            $telefone->ddd = $request->ddd;
            $telefone->numero = $request->numero;

            // Salvamos o telefone
            $this->telefonesController->store($telefone);
        }

        // Redirecionamos para a página inicial com a mensagem de sucesso
        return redirect(route('pessoas.index'))->with('status', "Contato {$pessoa->nome} cadastrado com sucesso!");
    }

    // POST /delete
    public function delete(Request $request) {
        // Encontramos a pessoa
        $pessoa = \App\Pessoa::find($request->id_pessoa);

        // Deletamos-a de forma segura
        $pessoa->delete();
        
        // Redirecionamos para a página inicial com a mensagem de sucesso
        return redirect(route('pessoas.index'))->with('status', "Contato {$pessoa->nome} excluído com sucesso.");
    }

}
