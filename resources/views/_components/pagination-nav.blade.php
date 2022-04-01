<nav>
    <ul class="pagination flex-wrap">
        <li class="page-item">
            <a class="page-link" href="{{ $list->previousPageUrl() }}">Voltar</a>
        </li>

        @for( $i = 1; $i <= $list->lastPage(); $i++)
            <li class="page-item {{ $list->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{$list->url($i)}}">{{$i}}</a>
            </li>
        @endfor

        <li class="page-item">
            <a class="page-link" href="{{ $list->nextPageUrl() }}">Avançar</a>
        </li>
    </ul>
</nav>