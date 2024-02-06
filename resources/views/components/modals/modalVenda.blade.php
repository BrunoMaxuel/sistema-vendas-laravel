<style>
    .custom-input{
        background-color: transparent;
        border: none;
        color: white;
        width: 80px;
    }
    .custom-input:focus{
        outline: none;
    }
</style>

<div class="modal fade " id="modalTransacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" id="modalHeader">
            <h6 class="modal-title">Finalização de venda</h6>
        </div>
        <div id="modalBody" class="modal-body p-3">
            <form id="formTransacao" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" id="venda_detalhada" name="venda_detalhada">
                    <div class="m-1">

                    </div>
                    <div class="col m-1 border">
                        <h6>TOTAL DA VENDA</h6>
                        <input type="text" id="total_venda_modal" class="custom-input" name="total_venda" value="11120,00" readonly>
                    </div>
                    <div class="col m-1 border">
                        <h6>TOTAL COM DESCONTO</h6>
                        <input type="text" id="venda_desconto_modal" class="custom-input" name="venda_desconto" value="0,00" readonly>
                    </div> 
                    <div class="col m-1 border">
                        <h6>TOTAL ITENS</h6>
                        <input type="text" id="total_item_modal" class="custom-input" name="total_item" value="0" readonly>
                    </div>
                </div>
                
                <div class="row p-2">
                    <div class="col-md-4">
                        <label>Valor recebido</label>
                        <input id="valor_recebido" data-mask="000.000,00" data-mask-reverse="true" class="form-control"/>
                    </div>
                    <div class="col-md-3 ">
                        <label>Desconto</label>
                        <input id="desconto" data-mask="000%" value="0" data-mask-reverse="true" name="desconto" class="form-control"/>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-end">
                        <h4>TROCO <i class="fas fa-arrow-right"> </i><h3 id="troco" class="ml-3"><strong>0,00</strong></h3></h4> 
                    </div>
                </div>

                <div class="row p-2 mb-3">
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
                        <select id="parcela" name="parcela" class="form-control" >
                            <option value="1x">1x</option>
                            <option value="2x">2x</option>
                            <option value="3x">3x</option>
                            <option value="4x">4x</option>
                            <option value="5x">5x</option>
                            <option value="6x">6x</option>
                            <option value="7x">7x</option>
                            <option value="8x">8x</option>
                            <option value="9x">9x</option>
                            <option value="10x">10x</option>
                            <option value="11x">11x</option>
                            <option value="12x">12x</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Parcela(R$)</label>
                        <input id="valor_parcela" name="valor_parcela" readonly data-mask-reverse="true" class="form-control"/>
                    </div>
                </div>
                <div class="row pl-2">
                    <div class="col-md-12">
                        <label for="">Cliente</label>
                    </div>
                </div>
                <div class="row pl-2">
                    <div class="col-md-7">
                        <input  id="cliente" class="form-control" name="cliente" placeholder="Pesquisar cliente" value="Visitante"/>
                    </div>
                    <div class="col-md-5 d-flex justify-content-end">
                        <button id="btnModalFinalizar" type="submit" class="btn btn-success mr-2">Finalizar venda</button>
                        <button id="btnModalCancel" type="button" class="btn btn-default">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>