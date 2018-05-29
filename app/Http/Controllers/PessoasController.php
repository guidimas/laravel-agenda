<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PessoasController extends Controller
{
    // Injecao de dependencias
    private $telefonesController;

    // Construtor da classe
    public function __construct(TelefonesController $telefonesController) {
        
        // Injetamos a TelefonesController
        $this->telefonesController = $telefonesController;
        
    }

    // GET /
    public function index() {
        // Lista todas as pessoas (não excluidas)
        $listaPessoas = \App\Pessoa::orderBy('nome', 'asc')->get();

        // Lista todas as pessoas excluidas
        $listaPessoasExcluidas = \App\Pessoa::onlyTrashed()->orderBy('nome', 'asc')->get();

        // Retorna a view com os dados
        return view('pessoas.index', [
            'listaPessoas' => $listaPessoas,
            'listaPessoasExcluidas' => $listaPessoasExcluidas
        ]);
    }

    // GET /create
    public function create() {
        return view('pessoas.create');
    }

    // POST /store
    public function store(Request $request) {
        // Validamos os dados (com redirect automatico)
        $this->validar($request)->validate();

        // // Validamos os dados
        // $validation = $this->validar($request);

        // // Se der erro
        // if ($validation->fails()) {
        //     return redirect()->back()->withErrors($request)->withInput();
        // }

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

    // GET /{id}/editar
    public function edit($id) {
        // Encontramos a pessoa no banco de dados
        $pessoa = $this->getPessoa($id);
        
        // Retornamos a view com os dados da pessoa para edição
        return view('pessoas.edit', ['pessoa' => $pessoa]);
    }

    // POST /atualizar
    public function update(Request $request) {
        // Encontramos a pessoa que deve ser alterada
        $pessoa = $this->getPessoa($request->input('pessoa_id'));

        // Alteramos os dados da pessoa
        $pessoa->nome = $request->input('nome');

        // Salvamos a pessoa
        $pessoa->save();

        // Redirecionamos para a página inicial com a mensagem de sucesso
        return redirect(route('pessoas.index'))->with('status', "Contato {$pessoa->nome} atualizado com sucesso!");
    }

    // POST /deletar
    public function delete(Request $request) {
        // Pegamos a pessoa
        $pessoa = $this->getPessoa($request->input('id_pessoa'));

        // Deletamos-a de forma segura (pois implementa o SoftDeletes)
        $pessoa->delete();
        
        // Redirecionamos para a página inicial com a mensagem de sucesso
        return redirect(route('pessoas.index'))->with('status', "Contato {$pessoa->nome} excluído com sucesso.");
    }

    // GET /{id}/restaurar
    public function restore($id) {
        // Pegamos a pessoa
        $pessoa = $this->getPessoaExcluida($id);

        // Restauramos a pessoa
        $pessoa->restore();

        // Redirecionamos para a página inicial com a mensagem de sucesso
        return redirect(route('pessoas.index'));
    }

    // Função que encontra a pessoa pelo id e a retorna
    private function getPessoa($id) {
        // Encontramos a pessoa
        $pessoa = \App\Pessoa::findOrFail($id);

        // Retornamos a pessoa encontrada
        return $pessoa;
    }

    // Função que encontra a pessoa excluida pelo id e a retorna
    private function getPessoaExcluida($id) {
        // Encontramos a pessoa excluida
        $pessoaExcluida = \App\Pessoa::withTrashed()->findOrFail($id);

        // Retornamos a pessoa excluida encontrada
        return $pessoaExcluida;
    }

    // Função que valida os campos
    private function validar($data) {

        // Definimos as regras para os campos
        $rules = [
            'nome' => 'required|string|max:150',
        ];

        // Definimos as mensagens de erro
        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome precisa ser um nome.',
            'nome.max' => 'O campo nome não pode ter mais de 150 caracteres.',
        ];


        return Validator::make($data->all(), $rules, $messages);
    }

}