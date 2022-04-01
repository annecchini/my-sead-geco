    {{-- Aviso de filtros --}}
    @php
        $have_filters_to_alert = false;
        foreach ($filter_list as $key => $filter) {
            if(app('request')->input($filter)) $have_filters_to_alert = true;
            break;
        }
    @endphp
    
    @if ($have_filters_to_alert)
        <div class="mt-3 alert alert-warning py-0">
            <div class="d-flex justify-content-end">
                <span class="flex-grow-1">Filtros aplicados!</span>
                <a class="ml-2" href="#" onclick="{{ isset($edit_function) ? $edit_function : "showFiltersModal();" }}">Editar</a>
                <a class="ml-2" href="{{ isset($reset_route) ? $reset_route : route('bond.index') }}">Remover</a>
            </div>
        </div>
    @endif