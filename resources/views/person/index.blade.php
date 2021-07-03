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
                        <a class="ml-1" href="{{route('person.create' )}}">Novo</a>
                    </div>

                    @if($people->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>CPF</th>
                                    <th>Nome</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $people as $person )
                                <tr>
                                    <td>{{ $person->cpf }}</td>
                                    <td>{{ $person->name }}</td>
                                    <td><a href="{{ route('person.show', ['person' => $person->id]) }}">Ver</a></td>
                                    <td><a href="{{ route('person.edit', ['person' => $person->id]) }}">Editar</a></td>
                                    <td>
                                        {{-- <form id="form_{{$person->id}}" method="post"
                                        action="{{ route('person.destroy', ['person' => $person->id] )}}">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        <a href="#" onclick="document.getElementById('form_{{$person->id}}').submit()">
                                            Excluir
                                        </a> --}}
                                        <a href="#"
                                            onclick="showDeleteModal({action:'{{ route('person.destroy', ['person' => $person->id]) }}'});">
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
                                <a class="page-link" href="{{ $people->previousPageUrl() }}">Voltar</a>
                            </li>

                            @for( $i = 1; $i <= $people->lastPage(); $i++)
                                <li class="page-item {{ $people->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{$people->url($i)}}">{{$i}}</a>
                                </li>
                                @endfor

                                <li class="page-item">
                                    <a class="page-link" href="{{ $people->nextPageUrl() }}">Avançar</a>
                                </li>
                        </ul>
                    </nav>

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

@endsection

@section('page-js-script')
<script type="text/javascript">
    function showDeleteModal(options){
        $('#deleteForm').attr('action', options.action);
        $('#deleteModal').modal('show');
    }
</script>
@endsection