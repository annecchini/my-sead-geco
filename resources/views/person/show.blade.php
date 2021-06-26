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

                        no data now...
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
@endsection