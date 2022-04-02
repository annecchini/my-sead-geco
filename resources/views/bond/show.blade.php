@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @component('_components.alert-success')@endcomponent

            <div class="card">

                <div class="card-header">
                    <a data-toggle="collapse" href="#collapseBond" role="button" aria-expanded="true"
                        aria-controls="collapseBond">{{ __('Vínculo') }}</a>
                </div>

                <div class="collapse show" id="collapseBond">
                    <div class="card-body">

                        <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                            <a class="ml-1" href="{{route('bond.edit', [ 'bond'=>$bond->id, 'from'=>'bond_show' ])}}">Editar</a>
                        </div>

                        <fieldset disabled>

                            <div class="form-group">
                                <label for="personImput">Colaborador</label>
                                <input type="text" class="form-control" id="personImput" name="person" value="{{ $bond->person->name }}">
                            </div>

                            <div class="form-group">
                                <label for="ocupationInput">Ocupação</label>
                                <input type="text" class="form-control" id="ocupationInput" name="ocupation" value="{{ $bond->ocupation->name }}">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="beginDateInput">Início</label>
                                    <input class="form-control" id="beginDateInput" type="date" value="{{\Carbon\Carbon::parse($bond->begin)->format('Y-m-d')}}" name="begin-date">
                                </div>
    
                                <div class="form-group col-6">
                                    <label for="beginTimeInput">.</label>
                                    <input class="form-control" id="beginTimeInput" type="time" step="1" value="{{\Carbon\Carbon::parse($bond->begin)->format('H:i:s')}}" name="begin-time">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="endDateInput">Fim</label>
                                    <input class="form-control" id="endDateInput" type="date" value="{{\Carbon\Carbon::parse($bond->end)->format('Y-m-d')}}" name="end-date">
                                </div>
    
                                <div class="form-group col-6">
                                    <label for="endTimeInput">.</label>
                                    <input class="form-control" id="endTimeInput" type="time" step="1" value="{{\Carbon\Carbon::parse($bond->end)->format('H:i:s')}}" name="end-time">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="courseImput">Curso</label>
                                <input type="text" class="form-control" id="courseImput" name="course" value="{{ isset($bond->course->name) ? $bond->course->name : '' }}">
                            </div>

                            <div class="form-group">
                                <label for="poleImput">Local</label>
                                <input type="text" class="form-control" id="poleImput" name="pole" value="{{ isset($bond->pole->name) ? $bond->pole->name : '' }}">
                            </div>

                        </fieldset>

                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

@endsection

