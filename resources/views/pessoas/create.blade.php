@extends('layouts.base')

@section('title', 'Cadastrar novo contato')

@section('content')

<form action="{{ route('pessoas.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label for="nome">Nome:</label>
        <input class="form-control" type="text" name="nome" maxlength="100" id="nome" placeholder="p. ex., Peter Parker" required autofocus>
    </div>

    <div class="form-group">
        <label for="telefone">Primeiro número:</label>
        <div id="telefone" class="input-group">
            <input class="form-control" style="max-width: 60px;" type="tel" name="ddd" id="ddd" maxlength="2" placeholder="DDD" required>        
            <input class="form-control" type="tel" name="numero" id="numero" maxlength="10" placeholder="Número, p. ex., 99999-8888" required>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Cadastrar</button>
    <a href="{{ route('pessoas.index') }}" class="btn btn-link">Voltar</a>

</form>

@endsection