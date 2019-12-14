<!-- Modal -->
<div class="modal fade modalcadastro" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Cadastro de categories</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form  class="form-horizontal formulariocadastro" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-2" for="name">Nome:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" name="name" id="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
