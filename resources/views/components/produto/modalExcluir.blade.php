<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalHeader" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        
          <div class="modal-header">
            <h3 class="modal-title" id="modalHeaderExcluir" style="color: red">Excluir Cliente</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div style="margin-top: 40px; margin-bottom: 40px ">
              <h3>Tem certeza que deseja excluir o cliente?</h3>
            </div>
          </div>
          <form id="formUpExcluir">
              @csrf
              <input type="hidden" name="id" id="idExcluir">      
              <div class="modal-footer">
                <button id="btnModaCancelar" type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <button id="btnModalExcluir" type="button" class="btn btn-danger">Excluir Cliente</button>
              </div>
          </form>
      </div>
    </div>
  </div>