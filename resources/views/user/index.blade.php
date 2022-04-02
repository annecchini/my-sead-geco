@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @component('_components.alerts-error')@endcomponent
            @component('_components.alert-success')@endcomponent

            <div class="card">

                <div class="card-header">
                    {{ __('Usuários') }}
                </div>

                <div class="card-body">

                    <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                        <a class="ml-2" href="#" onclick="showUserFiltersModal();">Filtrar</a>
                        <a class="ml-2" href="{{route('user.create' )}}">Novo</a>
                    </div>

                    @component('_components.alert-filters-applied', [
                        'filter_list' => App\Models\User::$accepted_filters,
                        'edit_function' =>"showFiltersModal();",
                        'reset_route' => route('user.index' ),
                    ])@endcomponent

                    @if($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>@sortablelink('email', 'E-mail')</th>
                                    <th>@sortablelink('person.name', 'Colaborador')</th>
                                    <th class="text-right">Ações</th>
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
                                    <td class="text-right">
                                        <a title="Ver" href="{{ route('user.show', ['user' => $user->id]) }}"><i class="bi bi bi-search"></i></a>
                                        <a title="Editar" href="{{ route('user.edit', ['user' => $user->id]) }}"><i class="bi bi-pencil"></i></a>
                                        <a 
                                            title="Excluir"
                                            href="#"
                                            onclick="showDeleteUserModal({action:'{{ route('user.destroy', ['user' => $user->id]) }}'});"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @component( '_components.pagination-nav', ['list'=>$users] )@endcomponent

                    @else
                    <p>Sem usuários para exibir.</p>
                    @endif

                </div>

            </div>


        </div>
    </div>
</div>

@component('user._components.deleteUserModal')@endcomponent
@component('user._components.userFiltersModal')@endcomponent

@endsection