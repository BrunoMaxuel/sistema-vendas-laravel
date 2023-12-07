<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="modalHeader">Alterar Informações do Produto</h5>
          <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formUp">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="nome">Nome do produto <span class="text-danger">*</span></label>
              <input type="text" id="nome" maxlength="50" required="required" name="nome" class="form-control" placeholder="Nome do produto">
              <span id="error-nome" class="text-danger"></span>
            </div>
            <div class="form-group">
              <label for="endereco">Código de barras</label>
              <input type="text" id="codigo_barras" maxlength="13" name="codigo_barras" class="form-control" placeholder="Insira um codigo de barras">
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="bairro">Preço de custo<span class="text-danger">*</span></label>
                <input type="text" id="preco_custo" name="preco_custo" class="form-control" placeholder="Qual o produto lhe custou...">
                <span id="error-preco-custo" class="text-danger"></span>
              </div>
              <div class="form-group col-md-6">
                <label for="preco">Preço de venda<span class="text-danger">*</span></label>
                <input type="text" id="preco" name="preco" class="form-control" placeholder="Preço de vender o produto...">
                <span id="error-preco" class="text-danger"></span>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="lucro">Lucro<span class="text-danger">*</span></label>
                <input type="text" id="lucro" name="lucro" class="form-control" >
                <span id="error-lucro" class="text-danger"></span>
              </div>
              <div class="form-group col-md-3">
                <label for="estoque">Estoque<span class="text-danger">*</span></label>
                <input type="number" id="estoque" name="estoque" class="form-control" >
                <span id="error-estoque" class="text-danger"></span>
              </div>
              <div class="form-group col-md-6">
                <label for="fornecedor">Fornecedor</label>
                <input type="text" id="fornecedor" maxlength="30" name="fornecedor" class="form-control" >
              </div>
                <div class="form-group col-md-6">
                  <label for="categoria">Categoria</label>
                  <select id="categoria" name="categoria" class="form-control">
                    <option value="Não selecionado" selected="selected">Não selecionado</option>
                    <option value="Eletronico">Eletrônicos</option>
                    <option value="Cama mesa e banho">Cama mesa e banho</option>
                    <option value="Artigos para presente">Artigos para presente</option>
                  </select>
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