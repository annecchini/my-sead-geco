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
                    @if (app('request')->input('name') || app('request')->input('cpf'))
                    <div class="mt-3 alert alert-warning">
                        <div class="d-flex justify-content-end">
                            <span class="flex-grow-1">Filtros aplicados!</span>
                            <a class="ml-2" href="#" onclick="showFiltersModal();">Editar</a>
                            <a class="ml-2" href="{{route('person.index' )}}">Remover</a>
                        </div>
                    </div>
                    @endif

                    @if($bonds->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Status</th>
                                        <th>Colaborador</th>
                                        <th>Ocupação</th>
                                        <th>Início</th>
                                        <th>Fim</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $bonds as $bond )
                                        <tr>
                                            <td>{{ $bond->id }}</td>
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
                                                <a title="Editar" href="{{ route('bond.edit', ['bond' => $bond->id]) }}"><i class="bi bi bi-pencil"></i></a>
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

@endsection

