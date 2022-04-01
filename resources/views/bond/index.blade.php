@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">

                <div class="card-header">
                    {{ __('Vínculos') }}
                </div>

                <div class="card-body">

                    <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                        <a class="ml-2" href="#" onclick="showFiltersModal();">Filtrar</a>
                        <a class="ml-2" href="{{route('bond.create' )}}">Novo</a>
                    </div>

                    {{-- Aviso de filtros --}}
                    @if (app('request')->input('status_is') 
                    || app('request')->input('person_like') 
                    || app('request')->input('ocupation_like') 
                    || app('request')->input('begin_gte')
                    || app('request')->input('begin_lte')
                    || app('request')->input('end_gte')
                    || app('request')->input('end_lte')
                    || app('request')->input('course_like')
                    || app('request')->input('pole_like')
                    )
                    <div class="mt-3 alert alert-warning py-0">
                        <div class="d-flex justify-content-end">
                            <span class="flex-grow-1">Filtros aplicados!</span>
                            <a class="ml-2" href="#" onclick="showFiltersModal();">Editar</a>
                            <a class="ml-2" href="{{route('bond.index' )}}">Remover</a>
                        </div>
                    </div>
                    @endif

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

                        <nav>
                            <ul class="pagination flex-wrap">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $bonds->previousPageUrl() }}">Voltar</a>
                                </li>
    
                                @for( $i = 1; $i <= $bonds->lastPage(); $i++)
                                    <li class="page-item {{ $bonds->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{$bonds->url($i)}}">{{$i}}</a>
                                    </li>
                                    @endfor
    
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $bonds->nextPageUrl() }}">Avançar</a>
                                    </li>
                            </ul>
                        </nav>
                    @else
                        <p>Sem vínculos para exibir.</p>
                    @endif

                </div>

            </div>


        </div>
    </div>
</div>

@component('bond._components.deleteBondModal'))@endcomponent
@component('bond._components.showFiltersModal'))@endcomponent

@endsection

