<!-- DeletePerson Modal -->
<div class="modal fade" id="deleteInternalNoteModal" tabindex="-1" role="dialog" aria-labelledby="deleteInternalNoteLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="deleteInternalNoteForm" action="">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteInternalNoteLabel">Excluir vínculo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Tem certeza que deseja remover esta nota interna?
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
    function showDeleteInternalNoteModal(options){
        $('#deleteInternalNoteForm').attr('action', options.action);
        $('#deleteInternalNoteModal').modal('show');
    }
</script>