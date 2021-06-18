@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    {{ __('Colaborador') }}
                </div>

                <div class="card-body">

                    <fieldset disabled>
                        <div class="form-group">
                            <label for="nomeInput">Nome</label>
                            <input type="text" class="form-control" id="nomeInput" name="nome"
                                value="{{ $person->nome }}">
                        </div>

                        <div class="form-group">
                            <label for="cpfInput">CPF</label>
                            <input type="text" class="form-control" id="cpfInput" name="cpf" value="{{ $person->cpf }}">
                        </div>
                    </fieldset>
                    <a class="btn btn-primary" href="{{ url()->previous() }}">Voltar</a>

                </div>

            </div>


        </div>
    </div>
</div>
@endsection