@extends('layouts.base')

@section('title', 'Editar contato')

@section('content')

<div class="row">
    <div class="col-8 col-xl-9">
        <form action="{{ route('pessoas.update') }}" method="POST">
        
            @csrf
            
            <input type="hidden" name="pessoa_id" value="{{ $pessoa->id }}">
        
            <div class="form-group">
                <label for="nome">Nome:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">#{{ $pessoa->id }}</span>
                    </div>
                    <input class="form-control" type="text" name="nome" maxlength="100" id="nome" placeholder="p. ex., Peter Parker" value="{{ $pessoa->nome }}" required>
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('pessoas.index') }}" class="btn btn-link">Voltar</a>
        
        </form>
    </div>
    <div class="col-4 col-xl-3 mt-3">
        <div class="card">
            <div class="card-header">
                Contatos
            </div>
            <ul class="list-group list-group-flush">
                @forelse($pessoa->telefones as $telefone)
                <li class="list-group-item">
                    ({{ $telefone->ddd }}) {{ $telefone->numero }}
                </li>
                @empty
                <li class="list-group-item">Sem números.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>


@endsection