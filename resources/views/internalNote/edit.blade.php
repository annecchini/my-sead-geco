@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    {{ __('Editar nota interna') }}
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('internal-note.update', ['internal_note'=>$internal_note->id,  'to'=>Request::input('from')]) }}">

                        @csrf
                        @method('PUT')

                        <input type="hidden" name="model_name" value="{{$internal_note->model_name}}">

                        <input type="hidden" name="model_id" value="{{$internal_note->model_id}}">

                        {{-- Erro de model_name --}}
                        @if( $errors->has('model_name') )
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{$errors->first('model_name')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        @endif

                        {{-- Erro de model_name --}}
                        @if( $errors->has('model_id') )
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{$errors->first('model_id')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        @endif

                        {{-- Erro de last_up_person_id --}}
                        @if( $errors->has('last_up_person_id') )
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{$errors->first('last_up_person_id')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="contentInput">Conteúdo da nota *</label>
                            <textarea 
                                class="form-control {{ $errors->has('content') ? 'is-invalid' : ''}}" 
                                id="contentInput" 
                                rows="3"
                                name='content'
                                placeholder="Escreva sua nota aqui..."
                            >{{old('content', $internal_note->content)}}</textarea>
                            @if( $errors->has('content') )
                            <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Atualizar</button>

                    </form>

                </div>

            </div>


        </div>
    </div>
</div>
@endsection