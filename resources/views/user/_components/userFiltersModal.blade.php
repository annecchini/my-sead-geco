<!-- showFilters Modal -->
<div class="modal fade" id="userFiltersModal" tabindex="-1" role="dialog" aria-labelledby="userFiltersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" id="userFiltersForm" action="{{route('user.index')}}">

                <div class="modal-header">
                    <h5 class="modal-title" id="userFiltersModalLabel">Fitros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="emailInput">E-mail</label>
                        <input type="text" class="form-control" id="emailInput" name="email_like" value="{{ app('request')->input('email_like') }}">
                    </div>

                    <div class="form-group">
                        <label for="personInput">Colaborador</label>
                        <input type="text" class="form-control"
                            id="personInput" name="person_like" value="{{ app('request')->input('person_like') }}">
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
    function showUserFiltersModal(){
        $('#userFiltersModal').modal('show');
    }
</script>