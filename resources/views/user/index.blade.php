@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    {{ __('Usuários') }}
                </div>

                <div class="card-body">

                    <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                        <a class="ml-2" href="#" onclick="showFiltersModal();">Filtrar</a>
                        <a class="ml-2" href="{{route('user.create' )}}">Novo</a>
                    </div>

                    {{-- Aviso de filtros --}}
                    @if (app('request')->input('email') || app('request')->input('name'))
                    <div class="mt-3 alert alert-warning">
                        
                        <div class="d-flex justify-content-end">
                            <span class="flex-grow-1">Filtros aplicados!</span>
                            <a class="ml-2" href="#" onclick="showFiltersModal();">Editar</a>
                            <a class="ml-2" href="{{route('user.index' )}}">Remover</a>
                        </div>
                    </div>
                    @endif

                    @if($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>@sortablelink('email', 'E-mail')</th>
                                    <th>@sortablelink('person.name', 'Colaborador')</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $users as $user )
                                <tr>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('person.show', ['person'=>$user->person->id]) }}">
                                            {{$user->person->name}}
                                        </a>
                                    </td>
                                    <td><a href="{{ route('user.show', ['user' => $user->id]) }}">Ver</a></td>
                                    <td><a href="{{ route('user.edit', ['user' => $user->id]) }}">Editar</a></td>
                                    <td>
                                        {{-- <form id="form_{{$user->id}}" method="post"
                                        action="{{ route('user.destroy', ['user' => $user->id] )}}">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        <a href="#" onclick="document.getElementById('form_{{$user->id}}').submit()">
                                            Excluir
                                        </a> --}}
                                        <a href="#"
                                            onclick="showDeleteModal({action:'{{ route('user.destroy', ['user' => $user->id]) }}'});">
                                            Excluir
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="{{ $users->previousPageUrl() }}">Voltar</a>
                            </li>

                            @for( $i = 1; $i <= $users->lastPage(); $i++)
                                <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{$users->url($i)}}">{{$i}}</a>
                                </li>
                                @endfor

                                <li class="page-item">
                                    <a class="page-link" href="{{ $users->nextPageUrl() }}">Avançar</a>
                                </li>
                        </ul>
                    </nav>

                    @else
                    <p>Sem usuários para exibir</p>
                    @endif






                </div>

            </div>


        </div>
    </div>
</div>

<!-- DeleteModal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="deleteForm" action="">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Excluir usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Tem certeza que deseja remover este usuário?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não! Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sim! Confirmar</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- showFilters Modal -->
<div class="modal fade" id="filtersModal" tabindex="-1" role="dialog" aria-labelledby="filtersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" id="filterForm" action="{{route('user.index')}}">

                <div class="modal-header">
                    <h5 class="modal-title" id="filtersModalLabel">Fitros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="emailInput">E-mail</label>
                        <input type="text" class="form-control" id="emailInput" name="email" value="{{ app('request')->input('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="nameInput">Colaborador</label>
                        <input type="text" class="form-control"
                            id="nameInput" name="name" value="{{ app('request')->input('name') }}">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aplicar filtros</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('page-js-script')
<script type="text/javascript">
    function showDeleteModal(options){
        $('#deleteForm').attr('action', options.action);
        $('#deleteModal').modal('show');
    }

    function showFiltersModal(){
        $('#filtersModal').modal('show');
    }
</script>
@endsection