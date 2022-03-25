@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @component('person._components.person-navbar',  ['person'=>$person]))@endcomponent

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
                                            <a href="{{ route('document.edit', ['document'=>$document->id, 'person_id'=>$document->person_id]) }}">Editar</a>
                                        </td>
                                        <td>
                                            <a href="#" onclick="showDeleteDocumentModal({action:'{{ route('document.destroy', ['document' => $document->id]) }}'});">Excluir</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </div>
                        @else
                        <p>Sem documentos para exibir.</p>
                        @endif

                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>

@endsection