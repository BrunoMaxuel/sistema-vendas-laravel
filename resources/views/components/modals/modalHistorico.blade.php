<div class="modal fade" id="modalHistorico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content p-3">
        <div style="background-color: #343A40; color: white;" class="modal-header d-flex justify-content-center" id="modalHeader">
            <h4 class="modal-title-visualizar">Detalhes da venda</h4>
            <input type="hidden" id="id_transacao">
        </div>
        <div id="modalBody" style="background-color: #454D55 !important;" class="modal-body p-3">
            <div class="row">
                <div class="col ">
                    Forma de pagamento: <h5 class="pagamento"></h5>
                </div>
                <div class="col ">
                    Parcela: <h5 class="parcela"></h5>
                </div>
                <div class="col ">
                    Valor da parcela: <h5 class="valor_parcela"></h5>
                </div>
            </div>
            <table id="table-vendaDetalhe" class="table hover order-column compact table-bordered" cellspacing="0" width="100%">
                <thead class="thead-light">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Total(R$)</th>
                </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button onclick="imprimir()" type="submit" class="btn btn-success">Imprimir</button>
            <button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>
<script>
    function imprimir(){
			var $id_transacao = $('#id_transacao').val();
			var url = "/historico/imprimirVendaDetalhada/"+ $id_transacao;
			imprimirConteudo(url);
		}
</script>