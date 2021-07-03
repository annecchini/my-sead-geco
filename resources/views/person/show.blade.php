@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <a data-toggle="collapse" href="#collapsePerson" role="button" aria-expanded="true"
                        aria-controls="collapsePerson">{{ __('Colaborador') }}</a>
                </div>

                <div class="collapse show" id="collapsePerson">
                    <div class="card-body">

                        <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                            <a class="ml-1" href="{{route('person.edit', [ 'person'=>$person->id ])}}">Editar</a>
                        </div>

                        <fieldset disabled>
                            <div class="form-group">
                                <label for="nameInput">Nome</label>
                                <input type="text" class="form-control" id="nameInput" name="name"
                                    value="{{ $person->name }}">
                            </div>

                            <div class="form-group">
                                <label for="cpfInput">CPF</label>
                                <input type="text" class="form-control" id="cpfInput" name="cpf"
                                    value="{{ $person->cpf }}">
                            </div>
                        </fieldset>

                    </div>
                </div>

            </div>


            <div class="card">

                <div class="card-header">
                    <a data-toggle="collapse" href="#collapseDocuments" role="button" aria-expanded="true"
                        aria-controls="collapseDocuments">{{ __('Documentos cadastrados') }}</a>
                </div>

                <div class="collapse show" id="collapseDocuments">
                    <div class="card-body">

                        <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                            <a class="ml-1" href="{{route('document.create', ['person_id'=>$person->id] )}}">Novo</a>
                        </div>

                        @if(count($person->documents) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Data de criação</th>
                                        <th>Documento</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $person->documents as $document )
                                    <tr>
                                        <td>{{ $document->created_at->format('Y/m/d H:i:s')}}</td>
                                        <td>
                                            <a target="_blank" href="{{ route('document.show', ['document'=>$document->id]) }}">
                                                {{ $document->documentType->name }} {{ $document->alias ? " ($document->alias)" : ""}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('document.edit', ['document'=>$document->id]) }}">Editar</a>
                                        </td>
                                        <td>
                                            <a href="#" onclick="showDeleteDocumentModal({action:'{{ route('document.destroy', ['document' => $document->id]) }}'});">Excluir</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </div>
                        @else
                        <p>Sem documentos para exibir</p>
                        @endif

                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

<!-- DeleteDocument Modal -->
<div class="modal fade" id="deleteDocumentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="deleteDocumentForm" action="">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="documentModalLabel">Excluir documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Tem certeza que deseja remover este documento?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não! Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sim! Confirmar</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('page-js-script')

    <script type="text/javascript">
        function showDeleteDocumentModal(options){
            $('#deleteDocumentForm').attr('action', options.action);
            $('#deleteDocumentModal').modal('show');
        }
    </script>

@endsection