<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalHeader">Alterar Cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formUp">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="nome">Nome do cliente</label>
              <input type="text" id="nome" maxlength="100" required="required" name="nome" class="form-control" placeholder="Nome">
            </div>
            <div class="form-group">
              <label for="endereco">Endereço</label>
              <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Ex. Rua Brasil 999">
            </div>
            <div class="form-group">
              <label for="telefone">Telefone</label>
              <input type="tel" id="tel1" name="telefone" class="form-control" placeholder="Telefone">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="sexo">Sexo do cliente</label>
                <select id="sexo" name="sexo" class="form-control">
                  <option value="I">Não especificado</option>
                  <option value="F">Feminino</option>
                  <option value="M">Masculino</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" class="form-control" placeholder="CEP">
              </div>
            </div>
            <div class="form-row">
              
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro">
              </div>
              <div class="form-group col-md-6">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade">
              </div>
            </div>
            <div class="form-group">
              <label for="estado">Estado</label>
              <select name="estado" id="uf" class="form-control">
                <option value="" selected>Selecionar</option>
                  <option value="AC">Acre</option>
                  <option value="AL">Alagoas</option>
                  <option value="AP">Amapá</option>
                  <option value="AM">Amazonas</option>
                  <option value="BA">Bahia</option>
                  <option value="CE">Ceará</option>
                  <option value="DF">Distrito Federal</option>
                  <option value="ES">Espírito Santo</option>
                  <option value="GO">Goiás</option>
                  <option value="MA">Maranhão</option>
                  <option value="MT">Mato Grosso</option>
                  <option value="MS">Mato Grosso do Sul</option>
                  <option value="MG">Minas Gerais</option>
                  <option value="PA">Pará</option>
                  <option value="PB">Paraíba</option>
                  <option value="PR">Paraná</option>
                  <option value="PE">Pernambuco</option>
                  <option value="PI">Piauí</option>
                  <option value="RJ">Rio de Janeiro</option>
                  <option value="RN">Rio Grande do Norte</option>
                  <option value="RS">Rio Grande do Sul</option>
                  <option value="RO">Rondônia</option>
                  <option value="RR">Roraima</option>
                  <option value="SC">Santa Catarina</option>
                  <option value="SP">São Paulo</option>
                  <option value="SE">Sergipe</option>
                  <option value="TO">Tocantins</option>
              </select>
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