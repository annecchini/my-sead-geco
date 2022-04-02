@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @component('_components.alerts-error')@endcomponent
            @component('_components.alert-success')@endcomponent

            <div class="card">

                <div class="card-header">
                    {{ __('Colaboradores') }}
                </div>

                <div class="card-body">

                    <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                        <a class="ml-2" href="#" onclick="showPersonFiltersModal();">Filtrar</a>
                        <a class="ml-2" href="{{route('person.create' )}}">Novo</a>
                    </div>
                    
                    @component('_components.alert-filters-applied', [
                        'filter_list' => App\Models\Person::$accepted_filters,
                        'edit_function' =>"showPersonFiltersModal();",
                        'reset_route' => route('person.index' ),
                    ])@endcomponent
                                        
                    @if($people->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>@sortablelink('cpf', 'CPF')</th>
                                    <th>@sortablelink('name', 'Nome')</th>
                                    <th class="text-right">Ações</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $people as $person )
                                <tr>
                                    <td>{{ $person->cpf }}</td>
                                    <td>{{ $person->name }}</td>
                                    <td class="text-right">
                                        <a title="Ver" href="{{ route('person.show', ['person' => $person->id]) }}"><i class="bi bi bi-search"></i></a>
                                        <a title="Editar" href="{{ route('person.edit', ['person' => $person->id]) }}"><i class="bi bi bi-pencil"></i></a>
                                        <a title="Excluir" href="#"
                                            onclick="showDeletePersonModal({action:'{{ route('person.destroy', ['person' => $person->id]) }}'});">
                                            <i class="bi bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @component('_components.pagination-nav', ['list'=>$people]))@endcomponent

                    @else
                    <p>Sem colaboradores para exibir</p>
                    @endif

                </div>

            </div>


        </div>
    </div>
</div>

@component('person._components.deletePersonModal')@endcomponent
@component('person._components.showPersonFiltersModal')@endcomponent

@endsection