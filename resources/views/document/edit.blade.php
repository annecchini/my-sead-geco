@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    {{ __('Editar documento') }}
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('document.update', ['document'=>$document->id]) }}" enctype="multipart/form-data">

                        @csrf

                        @method('PUT')

                        <div class="form-group">
                            <label for="personInput">Colaborador associado *</label>
                            <select id="personInput"
                                class="form-control {{ $errors->has('person_id') ? 'is-invalid' : ''}}"
                                name="person_id">
                                <option value="">-- Selecione um colaborador --</option>
                                @foreach ( $people as $person )
                                <option value="{{ $person->id }}"
                                    {{ old('person_id', $document->person_id) == $person->id ? 'selected' : '' }}>
                                    {{$person->name}} ({{$person->cpf}})
                                </option>
                                @endforeach
                            </select>
                            @if( $errors->has('person_id') )
                            <div class="invalid-feedback">{{ $errors->first('person_id') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="documentTypeInput">Tipo do documento *</label>
                            <select id="documentTypeInput"
                                class="form-control {{ $errors->has('documentType_id') ? 'is-invalid' : ''}}"
                                name="documentType_id">
                                <option value="">-- Selecione um tipo de documento --</option>
                                @foreach ( $documentTypes as $documentType )
                                <option value="{{ $documentType->id }}" {{ old('documentType_id', $document->documentType_id) == $documentType->id ? 'selected' : '' }}>
                                    {{$documentType->name}}
                                </option>
                                @endforeach
                            </select>
                            @if( $errors->has('documentType_id') )
                            <div class="invalid-feedback">{{ $errors->first('documentType_id') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="aliasInput">Apelido</label>
                            <input type="text" class="form-control {{ $errors->has('alias') ? 'is-invalid' : ''}}"
                                id="aliasInput" name="alias" value="{{ old('alias', $document->alias) }}">
                            @if( $errors->has('alias') )
                            <div class="invalid-feedback">{{ $errors->first('alias') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="filePathInput">Arquivo <a target="_blank" href="{{route('document.show', ['document'=>$document->id])}}">(Ver arquivo atual)</a> </label>
                            <input type="file" name="filePath" class="form-control-file border rounded is-invalid"
                                id="filePathInput">
                            @if( $errors->has('filePath') )
                            <div class="invalid-feedback">{{ $errors->first('filePath') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Atualizar</button>
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