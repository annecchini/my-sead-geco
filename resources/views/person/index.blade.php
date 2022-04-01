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
                    {{ __('Colaboradores') }}
                </div>

                <div class="card-body">

                    <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                        <a class="ml-2" href="#" onclick="showFiltersModal();">Filtrar</a>
                        <a class="ml-2" href="{{route('person.create' )}}">Novo</a>
                    </div>
                    
                    @component('_components.filters-alert', [
                        'filter_list' => ['name', 'cpf'],
                        'edit_function' =>"showFiltersModal();",
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
                                            onclick="showDeleteModal({action:'{{ route('person.destroy', ['person' => $person->id]) }}'});">
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

<!-- DeletePerson Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="personModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="deleteForm" action="">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="personModalLabel">Excluir colaborador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Tem certeza que deseja remover este colaborador?
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
            <form method="GET" id="filterForm" action="{{route('person.index')}}">

                <div class="modal-header">
                    <h5 class="modal-title" id="filtersModalLabel">Fitros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="cpfInput">CPF</label>
                        <input type="text" class="form-control" id="cpfInput" name="cpf" value="{{ app('request')->input('cpf') }}">
                    </div>

                    <div class="form-group">
                        <label for="nameInput">Nome</label>
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