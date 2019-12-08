
<!-- Modal -->
<div class="modal fade modalcadastro" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Cadastro de Categorias</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form  class="form-horizontal formulariocadastro" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-2" for="email">Nome:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nome" id="nome">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btncadastrar" class="btn btn-primary">Cadastrar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>
