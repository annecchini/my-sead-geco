@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    {{ __('Colaboradores') }}
                    <a class="float-right" href="{{ route('person.create') }}">Novo</a>
                </div>

                <div class="card-body">

                    @if($people->count() > 0)
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
                                <td>{{ $person->nome }}</td>
                                <td><a href="{{ route('person.show', ['person' => $person->id]) }}">Ver</a></td>
                                <td><a href="{{ route('person.edit', ['person' => $person->id]) }}">Editar</a></td>
                                <td>
                                    <form id="form_{{$person->id}}" method="post"
                                        action="{{ route('person.destroy', ['person' => $person->id] )}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="#" onclick="document.getElementById('form_{{$person->id}}').submit()">
                                        Excluir
                                    </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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
@endsection