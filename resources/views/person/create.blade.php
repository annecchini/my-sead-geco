@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    {{ __('Cadastrar colaborador') }}
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('person.store') }}">

                        @csrf

                        <div class="form-group">
                            <label for="nameInput">Nome *</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                                id="nameInput" name="name" value="{{ old('name', '') }}">
                            @if( $errors->has('name') )
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="cpfInput">CPF *</label>
                            <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : ''}}"
                                id="cpfInput" name="cpf" value="{{ old('cpf', '') }}">
                            @if( $errors->has('cpf') )
                            <div class="invalid-feedback">{{ $errors->first('cpf') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="mother_nameInput">Nome da mãe</label>
                            <input type="text" class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : ''}}"
                                id="cpfInput" name="mother_name" value="{{ old('mother_name', '') }}">
                            @if( $errors->has('mother_name') )
                            <div class="invalid-feedback">{{ $errors->first('mother_name') }}</div>
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