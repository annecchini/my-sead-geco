@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    {{ __('Cadastrar usuário') }}
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('user.store') }}">

                        @csrf

                        <div class="form-group">
                            <label for="emailInput">E-mail *</label>
                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}"
                                id="emailInput" name="email" value="{{ old('email', '') }}">
                            @if( $errors->has('email') )
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="passwordInput">Senha *</label>
                            <input type="password"
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}"
                                id="passwordInput" name="password" value="{{ old('password', '') }}">
                            @if( $errors->has('password') )
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="personInput">Colaborador responsável *</label>
                            <select id="personInput"
                                class="form-control {{ $errors->has('person_id') ? 'is-invalid' : ''}}"
                                name="person_id">
                                <option value="">-- Selecione um colaborador --</option>
                                @foreach ( $people as $person )
                                <option value="{{ $person->id }}"
                                    {{ old('person_id') == $person->id ? 'selected' : '' }}>
                                    {{$person->name}} ({{$person->cpf}})
                                </option>
                                @endforeach
                            </select>
                            @if( $errors->has('person_id') )
                            <div class="invalid-feedback">{{ $errors->first('person_id') }}</div>
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