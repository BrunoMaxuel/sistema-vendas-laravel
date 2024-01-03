<div class="modal fade " id="modalFinalizarVenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" id="modalHeader">
            <h6 class="modal-title">Finalização de venda</h6>
        </div>
        <div id="modalBody" class="modal-body p-3">
            <form id="vendaForm" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" id="id_transacao">
                    <div style="background-color: #0A8DC6; color:white;" class="col-md-4  border">
                        <h5>Total da venda</h5>
                        <h5 id="total_venda" class="ml-5" name="total"><strong>0,00</strong></h5>
                    </div> 
                    <div style="background-color: #0A8DC6; color:white;" class="col-md-4 ">
                        <h5>Venda com desconto</h5>
                        <h5 id="venda_desconto" class="ml-5" name="total"><strong>0,00</strong></h5>
                    </div> 
                    <div style="background-color: #0A8DC6; color:white;" class="col-md-4  border">
                        <h5>Itens</h5>
                        <h5 id="total_itens" class="ml-5"><strong>0</strong></h5>
                    </div>
                    <div class="col-md-4">
                        <label>Valor recebido</label>
                        <input id="valor_recebido" data-mask="000.000,00" data-mask-reverse="true" name="valor_dinheiro" class="form-control"/>
                    </div>
                    <div class="col-md-3 ">
                        <label>Desconto</label>
                        <input id="desconto" data-mask="000%" value="0" data-mask-reverse="true" name="desconto" class="form-control"/>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-end">
                        <h4>TROCO <i class="fas fa-arrow-right"> </i><h3 id="troco" class="ml-3"><strong>0,00</strong></h3></h4> 
                        
                    </div>
                    <div class="col-md-3">
                        <label>Pagamento</label>
                        <select id="pagamento" name="pagamento" class="form-control">
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Crédito">Crédito</option>
                            <option value="Débito">Débito</option>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                        <label>Parcela(R$)</label>
                        <input id="valor_parcela" name="valor_parcelas" readonly data-mask-reverse="true" class="form-control"/>
                    </div>
                    <div class="col-md-7">
                        <label for="">Cliente</label>
                        <input  id="cliente" class="form-control" name="cliente" placeholder="Pesquisar cliente" value="Visitante"/>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button id="finalizarVenda" type="button" class="btn btn-success">Finalizar venda</button>
            <button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>