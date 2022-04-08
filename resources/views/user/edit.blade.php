@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    {{ __('Editar usuário') }}
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('user.update', ['user'=>$user->id, 'to'=>Request::input('from') ]) }}">

                        @csrf

                        @method('PUT')

                        <div class="form-group">
                            <label for="emailInput">E-mail *</label>
                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}"
                                id="emailInput" name="email" value="{{ old('email', $user->email) }}">
                            @if( $errors->has('email') )
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="cpCheck" name="changePassword"
                                    data-toggle="collapse" data-target="#optionalPassword"
                                    {{ old('changePassword') === 'on' ? 'checked' : ''}}>
                                <label class="custom-control-label" for="cpCheck">Alterar senha do usuário</label>
                            </div>
                        </div>

                        <div id="optionalPassword" class="collapse">
                            <div class="form-group">
                                <label for="passwordInput">Senha *</label>
                                <input type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}"
                                    id="passwordInput" name="password" value="{{ old('password', '') }}">
                                @if( $errors->has('password') )
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label for="personInput">Colaborador responsável *</label>
                            <select id="personInput"
                                class="form-control {{ $errors->has('person_id') ? 'is-invalid' : ''}}"
                                name="person_id">
                                <option value="">-- Selecione um colaborador --</option>
                                @foreach ( $people as $person )
                                <option value="{{ $person->id }}"
                                    {{ old('person_id', $user->person_id) == $person->id ? 'selected' : '' }}>
                                    {{$person->name}} ({{$person->cpf}})
                                </option>
                                @endforeach
                            </select>
                            @if( $errors->has('person_id') )
                            <div class="invalid-feedback">{{ $errors->first('person_id') }}</div>
                            @endif
                        </div> --}}

                        @component( '_components.select-input', [
                            'inputId'=>'personInput',
                            'inputName'=>'person_id',
                            'inputLabel'=>'Colaborador responsável *',
                            'inputEmptyOption'=>'-- Selecione um colaborador --', //opcional
                            'itemList'=> $people,
                            //'optionValueFunction'=> function ($item) { return $item->id; }, //opcional
                            'optionNameFunction'=> function ($item) { return $item->name." (".$item->cpf.")"; }, //opcional                             
                            'errorList'=> $errors,
                            //'errorField'=>'person_id', //opcional
                            'resourceToUpdateValue'=> $user->person_id, //opcional, use no edit.
                        ] )@endcomponent

                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>


                </div>

            </div>


        </div>
    </div>
</div>
@endsection

@section('page-js-files')
<script src="{{ asset('js/user/edit.js') }}" defer></script>
@endsection