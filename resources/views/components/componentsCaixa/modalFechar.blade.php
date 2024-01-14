<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content p-4">
            <div id="modalHeader" class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Fechamento do Caixa</h4>
            </div>
            <div id="modalBody"class="modal-body">
                <h4>O saldo atual do caixa é : <strong>R${{$total}}</strong></h4>
            </div>
            
            <form action="{{route('caixa.fechar')}}" method="POST">
                @csrf
                <div class="modal-footer justify-content-center">
                    <button type="submit" id="btnSubmit"class="btn btn-success  p-2 pl-4 pr-4" >Fechar o caixa</button>
                    <button type="button" id="btnModal"class="btn btn-info p-2 pl-5 pr-5" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>