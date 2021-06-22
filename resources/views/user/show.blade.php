@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    {{ __('Usuário') }}
                </div>

                <div class="card-body">

                    <fieldset disabled>

                        <div class="form-group">
                            <label for="emailInput">E-mail</label>
                            <input type="text" class="form-control" id="emailInput" name="email"
                                value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="form-group">
                            <label for="personInput">Colaborador responsável</label>
                            <select id="personInput" class="form-control" name="person_id">
                                <option value="{{ $user->person->id }}" selected>
                                    {{$user->person->name}} ({{$user->person->cpf}})
                                </option>
                            </select>
                        </div>

                    </fieldset>
                    <a class="btn btn-primary" href="{{ url()->previous() }}">Voltar</a>

                </div>

            </div>


        </div>
    </div>
</div>
@endsection