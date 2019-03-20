@extends('layouts.base')

@section('title', 'Lista de contatos')

@section('content')
    
<a href="{{ route('pessoas.create') }}" class="btn btn-primary">Novo contato</a>

<div class="row">
    @foreach ($listaPessoas as $pessoa)
    <div class="col-4 col-xl-3 mt-3">
        <div class="card">
            <div class="card-header text-truncate d-flex align-items-center justify-content-between">
                <div class="text-truncate">
                    {{ $pessoa->nome }}
                </div>
                <div class="action ml-2 text-right">
                    <a href="{{ route('pessoas.edit', [ 'id' => $pessoa->id ]) }}" class="small text-primary mr-1">Editar</a>
                    <a href="#!" class="small text-danger" data-toggle="modal" data-target="#excluirContato" data-nome-contato="{{ $pessoa->nome }}" data-id-contato="{{ $pessoa->id }}">Excluir</a>
                </div>
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
    @endforeach
</div>

<hr class="mt-4">

<h2 class="mt-4">Contatos excluídos</h2>

<div class="row">
    @foreach ($listaPessoasExcluidas as $pessoaExcluida)
    <div class="col-4 col-xl-3 mt-3">
        <div class="card">
            <div class="card-header">
                <div class="row no-gutters">
                    <div class="text-truncate col">
                        {{ $pessoaExcluida->nome }}
                    </div>
                    <div class="col d-flex align-items-center justify-content-end">
                        <a href="{{ route('pessoas.restore', [ 'id' => $pessoaExcluida->id ]) }}" class="small text-primary mr-1">Restaurar</a>
                        <a href="#!" id="desintegrar" data-id-contato="{{ $pessoaExcluida->id }}" class="small text-danger">Destruir</a>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($pessoaExcluida->telefones as $telefone)
                <li class="list-group-item">
                    ({{ $telefone->ddd }}) {{ $telefone->numero }}
                </li>
                @empty
                <li class="list-group-item">Sem números.</li>
                @endforelse
            </ul>
            <div class="card-body text-center p-2">
                <span class="small text-danger">Excluído em: {{ $pessoaExcluida->deleted_at->format('d/m/Y') }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="modal fade" id="excluirContato" tabindex="-1" role="dialog" aria-labelledby="excluirContatoTitulo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excluirContatoTitulo">Excluir contato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pessoas.delete') }}" method="POST">
                @csrf

                <!-- ID do contato -->
                <input id="idPessoa" type="hidden" name="id_pessoa">

                <div class="modal-body">
                    <h5 class="m-0">Tem certeza que deseja excluir o contato <span class="nome-pessoa weight-bold"></span>?</h5>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<form id="desintegrarForm" action="{{ route('pessoas.deleteForever') }}" method="POST">
    @csrf
    <input type="hidden" name="id_pessoa" id="idPessoa" value="0">
</form>

@endsection

@section('scripts')

<script>
    $(document).ready(function () {

        $('#desintegrar').on('click', function (event) {
            var button = $(this);
            var idContato = button.data('id-contato');
            var form = $('#desintegrarForm');

            // Set the value
            form.find('#idPessoa').val(idContato);

            // Submit form
            form.submit();
        });

        $('#excluirContato').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var nomeContato = button.data('nome-contato');
            var idContato = button.data('id-contato');

            var modal = $(this);
            modal.find('.nome-pessoa').text(nomeContato);
            modal.find('#idPessoa').val(idContato);
        });
        
    });
</script>

@endsection