@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @component('_components.alerts-error')@endcomponent
            @component('_components.alert-success')@endcomponent

            <div class="card">

                <div class="card-header">
                    {{ __('Vínculos') }}
                </div>

                <div class="card-body">

                    <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                        <a class="ml-2" href="#" onclick="showFiltersModal();">Filtrar</a>
                        <a class="ml-2" href="{{route('bond.create' )}}">Novo</a>
                    </div>

                    @component('_components.alert-filters-applied', [
                        'filter_list' => App\Models\Bond::$accepted_filters,
                        'edit_function' =>"showFiltersModal();",
                        'reset_route' => route('bond.index' ),
                    ])@endcomponent

                    @if($bonds->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>@sortablelink('status', 'Status')</th>
                                        <th>@sortablelink('person.name', 'Colaborador')</th>
                                        <th>@sortablelink('ocupation.name', 'Ocupação')</th>
                                        <th>@sortablelink('begin', 'Início')</th>
                                        <th>@sortablelink('end', 'Fim')</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $bonds as $bond )
                                        <tr>
                                            <td> @if($bond->status()) <i class="bi bi-circle-fill ml-2" style="color:lime"></i> @else <i class="bi bi-circle-fill ml-2" style="color:lightgray"></i> @endif </td>
                                            <td>
                                                <a href="{{ route('person.show', ['person'=>$bond->person->id]) }}">
                                                    {{$bond->person->name}}
                                                </a>
                                            </td>
                                            <td title="{{$bond->ocupation->name}}{{ isset($bond->course->name) ? " / ".$bond->course->name : '' }}{{ isset($bond->location->name) ? " / ".$bond->location->name : ''}}">
                                                {{$bond->ocupation->name}}
                                            </td>
                                            <td title="{{ \Carbon\Carbon::parse($bond->begin)->format('d/m/Y H:i:s')}}">{{ \Carbon\Carbon::parse($bond->begin)->format('d/m/Y')}}</td>
                                            <td title="{{ \Carbon\Carbon::parse($bond->end)->format('d/m/Y H:i:s')}}">{{ \Carbon\Carbon::parse($bond->end)->format('d/m/Y')}}</td>
                                            <td class="text-right">
                                                <a title="Ver" href="{{ route('bond.show', ['bond' => $bond->id]) }}"><i class="bi bi bi-search"></i></a>
                                                <a title="Editar" href="{{ route('bond.edit', ['bond' => $bond->id]) }}"><i class="bi bi bi-pencil"></i></a>
                                                <a title="Excluir" href="#"
                                                onclick="showDeleteModal({action:'{{ route('bond.destroy', ['bond' => $bond->id]) }}'});">
                                                <i class="bi bi bi-trash"></i>
                                            </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @component('_components.pagination-nav', ['list'=>$bonds]))@endcomponent

                    @else
                        <p>Sem vínculos para exibir.</p>
                    @endif

                </div>

            </div>


        </div>
    </div>
</div>

@component('bond._components.deleteBondModal')@endcomponent
@component('bond._components.showFiltersModal')@endcomponent

@endsection

