@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link" href="{{route('person.show', [ 'person'=>$person->id ])}}" >Dados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('document.personDocumentIndex', [ 'person'=>$person->id ])}}" >Documentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page">Vínculos</a>
            </li>
        </ul>

            <div class="card">

                <div class="card-header">
                    <a data-toggle="collapse" href="#collapsePerson" role="button" aria-expanded="true"
                        aria-controls="collapsePerson">{{ __('Vínculos') }}</a>
                </div>

                <div class="collapse show" id="collapsePerson">
                    <div class="card-body">

                        @if(count($person->bonds) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $person->bonds as $bond )
                                        <tr>
                                            <td>{{ $bond->id }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </div>
                        @else
                            <p>Sem vínculos para exibir.<p>
                        @endif
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>

@endsection