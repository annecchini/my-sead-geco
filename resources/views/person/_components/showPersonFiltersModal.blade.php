<!-- showFilters Modal -->
<div class="modal fade" id="personFiltersModal" tabindex="-1" role="dialog" aria-labelledby="personFiltersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" id="filterForm" action="{{route('person.index')}}">

                <div class="modal-header">
                    <h5 class="modal-title" id="personFiltersModalLabel">Fitros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="cpfInput">CPF</label>
                        <input type="text" class="form-control" id="cpfInput" name="cpf_like" value="{{ app('request')->input('cpf_like') }}">
                    </div>

                    <div class="form-group">
                        <label for="nameInput">Nome</label>
                        <input type="text" class="form-control"
                            id="nameInput" name="name_like" value="{{ app('request')->input('name_like') }}">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aplicar filtros</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function showPersonFiltersModal(){
        $('#personFiltersModal').modal('show');
    }
</script>