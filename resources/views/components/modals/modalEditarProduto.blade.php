<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <form id="formUp" action="" method="POST">
              @csrf
              <input type="hidden" name="id" id="id_hidden">
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
                  <input type="text" id="preco_custo" name="preco_custo" data-mask="000.000,00" data-mask-reverse="true" class="form-control" placeholder="Qual o produto lhe custou...">
                  <span id="error-preco-custo" class="text-danger"></span>
                </div>
                <div class="form-group col-md-6">
                  <label for="preco">Preço de venda<span class="text-danger">*</span></label>
                  <input type="text" id="preco" name="preco" data-mask="000.000,00" data-mask-reverse="true" class="form-control" placeholder="Preço de vender o produto...">
                  <span id="error-preco" class="text-danger"></span>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="lucro">Lucro<span class="text-danger">*</span></label>
                  <input type="text" id="lucro" data-mask="000%" data-mask-reverse="true" name="lucro" class="form-control" >
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
                      <option value="ELETRONICO">Eletrônicos</option>
                      <option value="CAMA, MESA, BANHO">Cama, Mesa e Banho</option>
                      <option value="ARTIGOS PARA PRESENTE">Artigos para Presente</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Salvar alterações</button>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>