<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalHeader" aria-hidden="true">
  <div class="modal-dialog modal-" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <p id="titulo">Excluir dados da lista</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <p>
                <strong id="corpo">Tem certeza que deseja excluir?</strong>
              </p>
          </div>
          <form id="formExcluir" action="" method="POST">
              @method('DELETE')    
              @csrf
              <input type="hidden" name="id" id="idExcluir">      
              <div class="modal-footer">
                <button id="btnModalCancelar" type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <button id="btnModalExcluir" type="submit" class="btn btn-danger">Excluir</button>
              </div>
          </form>
      </div>
  </div>
</div>