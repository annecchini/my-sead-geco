@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    {{ __('Cadastrar vínculo de trabalho') }}
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('bond.update', ['bond'=>$bond, 'to'=>Request::input('from')]) }}">

                        @csrf

                        @method('PUT')

                        <div class="form-group">
                            <label for="personInput">Colaborador *</label>
                            <select id="personInput"
                                class="form-control {{ $errors->has('person_id') ? 'is-invalid' : ''}}"
                                name="person_id">
                                <option value="">-- Selecione um colaborador --</option>
                                @foreach ( $people as $person )
                                <option value="{{ $person->id }}"
                                    {{ old('person_id') == $person->id ? 'selected' : ($bond->person_id == $person->id ? 'selected' : '')}}
                                >
                                    {{$person->name}} ({{$person->cpf}})
                                </option>
                                @endforeach
                            </select>
                            @if( $errors->has('person_id') )
                            <div class="invalid-feedback">{{ $errors->first('person_id') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="ocupationInput">Ocupação *</label>
                            <select id="ocupationInput"
                                class="form-control {{ $errors->has('ocupation_id') ? 'is-invalid' : ''}}"
                                name="ocupation_id">
                                <option value="">-- Selecione uma ocupação --</option>
                                @foreach ( $ocupations as $ocupation )
                                <option value="{{ $ocupation->id }}"
                                    {{ old('ocupation_id') == $ocupation->id ? 'selected' : ($bond->ocupation_id == $ocupation->id ? 'selected' : '')}}
                                >
                                    {{$ocupation->name}}
                                </option>
                                @endforeach
                            </select>
                            @if( $errors->has('ocupation_id') )
                            <div class="invalid-feedback">{{ $errors->first('ocupation_id') }}</div>
                            @endif
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="beginDateInput">Inicio *</label>
                                <input class="form-control {{ $errors->has('begin-date') ? 'is-invalid' : ''}}" id="beginDateInput" type="date" 
                                    value="{{ old('begin-date') ? old('begin-date') : \Carbon\Carbon::parse($bond->begin)->format('Y-m-d') }}" name="begin-date">
                                @if( $errors->has('begin-date') )
                                    <div class="invalid-feedback">{{ $errors->first('begin-date') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-6">
                                <label for="beginTimeInput">*</label>
                                <input class="form-control {{ $errors->has('begin-time') ? 'is-invalid' : ''}}" id="beginTimeInput" type="time" step="1" 
                                    value={{ old('begin-time') ? old('begin-time') : \Carbon\Carbon::parse($bond->begin)->format('H:i:s') }} name="begin-time">
                                @if( $errors->has('begin-time') )
                                    <div class="invalid-feedback">{{ $errors->first('begin-time') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="endDateInput">Fim</label>
                                <input class="form-control {{ $errors->has('end-date') ? 'is-invalid' : ''}}" id="endDateInput" type="date" 
                                    value="{{ old('end-date') ? old('end-date') : \Carbon\Carbon::parse($bond->end)->format('Y-m-d') }}" name="end-date">
                                @if( $errors->has('end-date') )
                                    <div class="invalid-feedback">{{ $errors->first('end-date') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-6">
                                <label for="endTimeInput">.</label>
                                <input class="form-control {{ $errors->has('end-time') ? 'is-invalid' : ''}}" id="endTimeInput" type="time" step="1" 
                                    value={{ old('end-time') ? old('end-time') : \Carbon\Carbon::parse($bond->end)->format('H:i:s') }} name="end-time">

                                @if( $errors->has('end-time') )
                                    <div class="invalid-feedback">{{ $errors->first('end-time') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="courseInput">Curso</label>
                            <select id="courseInput"
                                class="form-control {{ $errors->has('course_id') ? 'is-invalid' : ''}}"
                                name="course_id">
                                <option value="">-- Selecione um curso --</option>
                                @foreach ( $courses as $course )
                                <option value="{{ $course->id }}"
                                    {{ old('course_id') == $course->id ? 'selected' : ($bond->course_id == $course->id ? 'selected' : '') }}>
                                    {{$course->name}}
                                </option>
                                @endforeach
                            </select>
                            @if( $errors->has('course_id') )
                            <div class="invalid-feedback">{{ $errors->first('course_id') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="poleInput">Local</label>
                            <select id="poleInput"
                                class="form-control {{ $errors->has('pole_id') ? 'is-invalid' : ''}}"
                                name="pole_id">
                                <option value="">-- Selecione um local --</option>
                                @foreach ( $locations as $pole )
                                <option value="{{ $pole->id }}"
                                    {{ old('pole_id') == $pole->id ? 'selected' : ($bond->pole_id == $pole->id ? 'selected' : '') }}>
                                    {{$pole->name}}
                                </option>
                                @endforeach
                            </select>
                            @if( $errors->has('pole_id') )
                            <div class="invalid-feedback">{{ $errors->first('pole_id') }}</div>
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