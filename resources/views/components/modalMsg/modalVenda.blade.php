<div class="modal fade " id="modalFinalizarVenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" id="modalHeader">
            <h4 class="modal-title">Finalização de venda</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div id="modalBody" class="modal-body p-3">
            <form id="vendaForm" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>Total da venda</label>
                        <input id="total_venda"  name="total" class="form-control" readonly/>
                    </div> 
                    <div class="col-md-6">
                        <label>Total de itens</label>
                        <input id="total_item" class="form-control" readonly/>
                    </div>
                    <div class="col-md-4 col-md-offset-2">
                        <label>Valor recebido</label>
                        <input id="valor_recebido" data-mask="000 000.00" data-mask-reverse="true" name="valor_dinheiro" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <label>Troco</label>
                        <input id="troco" data-mask="000 000.00" data-mask-reverse="true" name="troco" value="0.00" class="form-control" readonly/>
                    </div>
                    <div class="col-md-4 col-md-offset-2">
                        <label>Desconto</label>
                        <input id="desconto" data-mask="000%" value="0%" readonly data-mask-reverse="true" name="desconto" class="form-control"/>
                    </div>
                    <div class="col-md-4 ">
                        <label>Pagamento</label>
                        <select id="pagamento" name="pagamento" class="form-control">
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Crédito">Crédito</option>
                            <option value="Débito">Débito</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Parcela </label>
                        <select id="parcela" name="parcelas" class="form-control"readonly="readonly">
                            <option value="1">1x</option>
                            <option value="2">2x</option>
                            <option value="3">3x</option>
                            <option value="4">4x</option>
                            <option value="5">5x</option>
                            <option value="6">6x</option>
                            <option value="7">7x</option>
                            <option value="8">8x</option>
                            <option value="9">9x</option>
                            <option value="10">10x</option>
                            <option value="11">11x</option>
                            <option value="12">12x</option>
                            
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Valor da parcela:</label>
                        <input id="valor_parcela" name="valor_parcelas"  data-mask="000 000.00" data-mask-reverse="true" class="form-control"/>
                    </div>
                    <div class="col-md-12">
                        <label for="">Cliente</label>
                        <input  id="cliente" class="form-control" name="cliente" placeholder="Pesquisar cliente" value="Visitante"/>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button id="finalizarVenda" type="submit" class="btn btn-success">Finalizar venda</button>
            <button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>