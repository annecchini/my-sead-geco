<!-- showFilters Modal -->
<div class="modal fade" id="filtersModal" tabindex="-1" role="dialog" aria-labelledby="filtersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" id="filterForm" action="{{route('bond.index')}}">

                <div class="modal-header">
                    <h5 class="modal-title" id="filtersModalLabel">Fitros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="statusInput">Status</label>
                        <select id="statusImput" class="form-control" name="status_is" value="">
                            <option value="">-- Selecione um status --</option>
                            <option value="1" {{ app('request')->input('status_is') == "1" ? 'selected' : ''}} >Ativo</option>
                            <option value="0" {{ app('request')->input('status_is') == "0" ? 'selected' : ''}} >Inativo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="personInput">Colaborador</label>
                        <input type="text" class="form-control" id="personInput" name="person_like" value="{{ app('request')->input('person_like') }}">
                    </div>

                    <div class="form-group">
                        <label for="ocupationInput">Ocupação</label>
                        <input type="text" class="form-control" id="ocupationInput" name="ocupation_like" value="{{ app('request')->input('ocupation_like') }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="begin_gte_Input">Início entre...</label>
                            <input type="date" class="form-control" id="begin_gte_Input" name="begin_gte" value="{{ app('request')->input('begin_gte') }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="begin_lte_Input">e...</label>
                            <input type="date" class="form-control" id="begin_lte_Input" name="begin_lte" value="{{ app('request')->input('begin_lte') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="end_gte_Input">Fim entre...</label>
                            <input type="date" class="form-control" id="end_gte_Input" name="end_gte" value="{{ app('request')->input('end_gte') }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="end_lte_Input">e...</label>
                            <input type="date" class="form-control" id="end_lte_Input" name="end_lte" value="{{ app('request')->input('end_lte') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="courseInput">Curso</label>
                        <input type="text" class="form-control" id="courseInput" name="course_like" value="{{ app('request')->input('course_like') }}">
                    </div>

                    <div class="form-group">
                        <label for="poleInput">Local</label>
                        <input type="text" class="form-control" id="poleInput" name="pole_like" value="{{ app('request')->input('pole_like') }}">
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
    function showFiltersModal(){
        $('#filtersModal').modal('show');
    }
</script>