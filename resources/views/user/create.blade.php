@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                                //resourceToUpdateValue=>$item->id, //opcional
                        ] )@endcomponent

                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>


                </div>

            </div>


        </div>
    </div>
</div>
@endsection


@section('page-js-files')
<script src="{{ asset('js/user/create.js') }}" defer></script>
@endsection

@section('page-js-script')
    <script type="text/javascript">
    //     async function getJsonPersonList(){
    //         try {
    //             //const response = await axios.get('/api/v1/person');
    //             const response = await axios.post('/api/v1/login', {email:'fernando.void@gmail.com', password:'senhafraca123'});
                
    //             console.log(response);
    //         } catch (error) {
    //             console.log(error.response.data);
    //         }
    //     }
    // </script>
@endsection
