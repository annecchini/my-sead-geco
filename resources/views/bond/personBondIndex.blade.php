@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        @component('person._components.person-navbar',  ['person'=>$person]))@endcomponent

            <div class="card">

                <div class="card-header">
                    <a data-toggle="collapse" href="#collapsePerson" role="button" aria-expanded="true"
                        aria-controls="collapsePerson">{{ __('Vínculos') }}</a>
                </div>

                <div class="collapse show" id="collapsePerson">
                    <div class="card-body">

                        <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                            <a class="ml-1" href="{{route('bond.create', ['person_id'=>$person->id, 'from'=>'person'] )}}">Novo</a>
                        </div>

                        @if(count($bonds) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Ocupação</th>
                                            <th>Inicio</th>
                                            <th>Fim</th>
                                            <th class="text-right">-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $bonds as $bond )
                                        <tr id="{{$bond->id}}">
                                            <td> @if($bond->status()) <i class="bi bi-circle-fill ml-2" style="color:lime"></i> @else <i class="bi bi-circle-fill ml-2" style="color:lightgray"></i> @endif </td>
                                            <td title="{{$bond->ocupation->name}}{{ isset($bond->course->name) ? " / ".$bond->course->name : '' }}{{ isset($bond->location->name) ? " / ".$bond->location->name : ''}}">
                                            {{$bond->ocupation->name}}
                                            </td>
                                            <td title="{{ \Carbon\Carbon::parse($bond->begin)->format('d/m/Y H:i:s')}}">{{ \Carbon\Carbon::parse($bond->begin)->format('d/m/Y')}}</td>
                                            <td title="{{ \Carbon\Carbon::parse($bond->end)->format('d/m/Y H:i:s')}}">{{ \Carbon\Carbon::parse($bond->end)->format('d/m/Y')}}</td>
                                            <td class="text-right">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </div>
                        @else
                            <p>Sem vínculos para exibir.<p>
                        @endif
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>

@endsection