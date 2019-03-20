@extends('layouts.base')

@section('title', 'Cadastrar novo contato')

@section('content')

<form action="{{ route('pessoas.store') }}" method="POST" novalidate>

    @csrf

    <div class="form-group">
        <label for="nome">Nome:</label>
        <input class="form-control{{ $errors->pessoa->has('nome') ? ' is-invalid' : '' }}" type="text" name="nome" maxlength="100" id="nome" placeholder="p. ex., Peter Parker" value="{{ old('nome') }}" required autofocus>
        @if($errors->pessoa->has('nome'))
        <div class="invalid-feedback">
            {{ $errors->pessoa->first('nome') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label for="telefone">Primeiro número:</label>
        <div id="telefone" class="input-group is-invalid">
            <input class="form-control{{ $errors->telefone->has('ddd') ? ' is-invalid' : '' }}" style="max-width: 60px;" type="tel" name="ddd" id="ddd" maxlength="2" placeholder="DDD" value="{{ old('ddd') }}" required>        
            <input class="form-control{{ $errors->telefone->has('numero') ? ' is-invalid' : '' }}" type="tel" name="numero" id="numero" maxlength="10" placeholder="Número, p. ex., 99999-8888" value="{{ old('numero') }}" required>
            @if($errors->telefone->has('ddd') || $errors->telefone->has('numero'))
            <div class="invalid-feedback">
                {{ $errors->telefone->first('ddd') }}
            </div>
            <div class="invalid-feedback">
                {{ $errors->telefone->first('numero') }}
            </div>
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-success">Cadastrar</button>
    <a href="{{ route('pessoas.index') }}" class="btn btn-link">Voltar</a>

</form>

@endsection