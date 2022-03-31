<!-- DeletePerson Modal -->
<div class="modal fade" id="deleteBondModal" tabindex="-1" role="dialog" aria-labelledby="personModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="deleteBondForm" action="">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="personModalLabel">Excluir vínculo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Tem certeza que deseja remover este vínculo?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não! Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sim! Confirmar</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function showDeleteModal(options){
        $('#deleteBondForm').attr('action', options.action);
        $('#deleteBondModal').modal('show');
    }
</script>