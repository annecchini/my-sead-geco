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

                        <div class="form-group">
                            <label for="person_datalist_Input">Colaborador responsável * (novo)</label>
                            <input id='person_datalist_Input' class="form-control" list="person_list" name="person_new_id"/>
                            <datalist id="person_list">
                                @foreach ( $people as $person )
                                    <option data-value="{{$person->id}}" value="{{$person->name}} ({{$person->cpf}})"></option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="form-group">
                        <label for="state">State:</label>
                            <input type="text" name="state" id="state" list="state_list">
                            <datalist id="state_list">
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <!-- etc -->
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label for="country">Country:</label>
                            <datalist id="country_list">
                            <select name="country">
                            <option value="AF">Afghanistan</option>
                            <option value="AX">Åland Islands</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <!-- more -->
                            </select>
                            If other, please specify:
                            </datalist>
                            <input type="text" name=”country” id=”country” list="country_list">
                        </div>

                        <button type="button" onclick="getJsonPersonList();" class="btn btn-primary">Testar axios</button>


                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>


                </div>

            </div>


        </div>
    </div>
</div>
@endsection

@section('page-js-script')
    <script type="text/javascript">
        async function getJsonPersonList(){
            try {
                const response = await axios.get('/api/v1/person');
                console.log(response);
            } catch (error) {console.error(error);}
        }
    </script>
@endsection
