@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        @component('person._components.person-navbar',  ['person'=>$person]))@endcomponent
        
        @component('_components.alert-success')@endcomponent

            <div class="card">

                <div class="card-header">
                    <a data-toggle="collapse" href="#collapsePerson" role="button" aria-expanded="true"
                        aria-controls="collapsePerson">{{ __('Notas internas') }}</a>
                </div>

                <div class="collapse show" id="collapsePerson">
                    <div class="card-body">

                        <div class="mb-1 pr-1 bg-light d-flex justify-content-end">
                            <a class="ml-1" href="{{route('internal-note.create', ['person_id'=>$person->id, 'from'=>'person'] )}}">Nova</a>
                        </div>

                        @if(count($internalNotes) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Conteúdo</th>
                                            <th class="text-right">-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $internalNotes as $internalNote )
                                        <tr id="{{$internalNote->id}}">

                                            <td title="{{\Carbon\Carbon::parse($internalNote->updated_at)->format('d/m/Y H:i:s')." / ". $internalNote->lastupdatePerson->name}}">{{ \Carbon\Carbon::parse($internalNote->updated_at)->format('d/m/Y')}}</td>


                                            <td title="">
                                                {{$internalNote->content}}
                                            </td>


                                            <td class="text-right">
                                                {{-- <a title="Ver" href="{{ route('bond.show', ['bond' => $internalNote->id]) }}"><i class="bi bi bi-search"></i></a> --}}
                                                <a title="Editar" href="{{ route('internal-note.edit', ['internal_note' => $internalNote->id, 'from'=>'person']) }}"><i class="bi bi bi-pencil"></i></a>
                                                <a title="Excluir" href="#"
                                                onclick="showDeleteInternalNoteModal({action:'{{ route('internal-note.destroy', ['internal_note' => $internalNote->id, 'to' => 'person']) }}'});">
                                                <i class="bi bi bi-trash"></i>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </div>
                        @else
                            <p>Sem notas internas para exibir.<p>
                        @endif
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>

@component('internalNote._components.deleteInternalNoteModal'))@endcomponent

@endsection