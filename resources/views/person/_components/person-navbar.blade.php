@php
    $items = [
        ['label'=>'Dados', 'route'=>route('person.show', [ 'person'=>$person->id ])],
        ['label'=>'Documentos', 'route'=>route('document.personDocumentIndex', [ 'person'=>$person->id ])],
        ['label'=>'Vínculos', 'route'=>route('bond.personBondIndex', [ 'person'=>$person->id ])]
    ]
@endphp

<div>
    <ul class="nav nav-tabs mb-4">
        @foreach($items as $item)
            <li class="nav-item">
                <a  class="nav-link {{Request::url() == $item['route'] ? 'active' : '' }}" href="{{$item['route']}}">{{$item['label']}}</a>
            </li>
        @endforeach
    </ul>
</div>