@extends('layouts.base')

@section('title', 'Lista de contatos')

@section('content')
    
    <a href="{{ route('pessoas.create') }}" class="btn btn-primary">Novo contato</a>

    <div class="row">
        @foreach ($listaPessoas as $pessoa)
        <div class="col-4 col-xl-3 mt-3">
            <div class="card">
                <div class="card-header text-truncate d-flex align-items-center justify-content-between">
                    {{ $pessoa->nome }}
                    <a href="#" class="small text-danger" data-toggle="modal" data-target="#excluirContato" data-nome-contato="{{ $pessoa->nome }}" data-id-contato="{{ $pessoa->id }}">Excluir</a>
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



@endsection

@section('scripts')

<script>
    $('#excluirContato').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var nomeContato = button.data('nome-contato');
        var idContato = button.data('id-contato');

        var modal = $(this);
        modal.find('.nome-pessoa').text(nomeContato);
        modal.find('#idPessoa').val(idContato);
    });
</script>

@endsection

{{-- cadeira area : roupas --}}