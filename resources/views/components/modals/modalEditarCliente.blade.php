<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="modalHeader">Alterar Informações do Cliente</h5>
          <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formUp">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="nome">Nome do cliente<span class="text-danger">*</label>
              <input type="text" id="nome" maxlength="100"  name="nome" class="form-control" placeholder="Nome">
              <span id="error-nome" class="text-danger"></span>
            </div>
            <div class="form-group">
              <label for="endereco">Endereço</label>
              <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Ex. Rua Brasil 999">
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="telefone">Telefone</label>
                <input type="tel" id="tel" name="telefone" class="form-control" placeholder="Telefone">
              </div>
              <div class="form-group col-md-6">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade">
              </div>
                
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button id="btnCancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button id="btnSubmit" type="button" class="btn btn-primary">Salvar alterações</button>
        </div>
      </div>
    </div>
  </div>