@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @component('_components.alert-success')@endcomponent

            <div class="card">

                <div class="card-header">
                    {{ __('Usuário') }}
                </div>

                <div class="card-body">

                    <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                        <a class="ml-1" href="{{route('user.edit', [ 'user'=>$user->id, 'from'=>'user_show' ])}}">Editar</a>
                    </div>

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

                </div>

            </div>


        </div>
    </div>
</div>
@endsection