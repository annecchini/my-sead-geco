@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    {{ __('Usuários') }}
                    <a class="float-right" href="{{ route('user.create') }}">Novo</a>
                </div>

                <div class="card-body">

                    @if($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>E-mail</th>
                                    <th>Nome</th>
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
                                        <form id="form_{{$user->id}}" method="post"
                                            action="{{ route('user.destroy', ['user' => $user->id] )}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="#" onclick="document.getElementById('form_{{$user->id}}').submit()">
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
@endsection