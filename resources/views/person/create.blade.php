@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    {{ __('Cadastrar colaborador') }}
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('person.store') }}">

                        @csrf

                        <div class="form-group">
                            <label for="nomeInput">Nome</label>
                            <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : ''}}"
                                id="nomeInput" name="nome" value="{{ old('nome', '') }}">
                            @if( $errors->has('nome') )
                            <div class="invalid-feedback">{{ $errors->first('nome') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="cpfInput">CPF</label>
                            <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : ''}}"
                                id="cpfInput" name="cpf" value="{{ old('cpf', '') }}">
                            @if( $errors->has('cpf') )
                            <div class="invalid-feedback">{{ $errors->first('cpf') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>


                </div>

            </div>


        </div>
    </div>
</div>
@endsection


@section('page-js-files')
<script src="{{ asset('js/person/create.update.js') }}" defer></script>
@endsection