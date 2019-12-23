<!-- Modal -->
<div class="modal fade modalcadastro" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Cadastro de Empresas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form  class="form-horizontal formulariocadastro" method="POST">
                <div class="modal-body">
                 <div class="form-group">
                  <label class="control-label col-md-2" for="email">Nome :</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="name" id="name">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2" for="email">Razão Social :</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="title" id="title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2" for="email">CNPJ :</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="document_number" id="document_number">
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" id="btncadastrar" class="btn btn-default">Cadastrar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
              </form>
        </div>
    </div>
</div>
