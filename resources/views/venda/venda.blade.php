@extends('adminlte::page')
@section('title', 'Realizar venda')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables.min.css') }}"/>
<style>
	#search{
		margin-left: 15px;
		margin-bottom: 15px;
		width: 350px;
		height: 40px;
		font-size: 25px;
        border-radius: 5px;
	}
    #display-tableApi{
        display: none;
    }
    .cor-linha{
        background-color: #0A8DC6; 
        border-radius: 10px;
    }
    .customize{
        border-radius: 10px;
        background-color: #6c757d;
        background-color: #007BFF;
    }
    #tableApi tbody tr {
    padding: 0px; /* Ajuste o valor conforme necessário */
    }


</style>
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<x-modalMsg.modalVenda/>
<x-modalMsg.modal/>

<div class="row p-2 cor-linha">
    <div class="col-md-8 p-2 cor-linha">
        <h4 class="text-light" style="margin-left: 17px">Código barras/Nome</h4>
        <div class="input-group-append search-input">
            <input type="text" id="search" placeholder="Pesquisar item para venda" oninput="convertToUpper(this)">
        </div>
    </div>
    <div class="col-md-4 cor-linha d-flex align-items-center justify-content-center">
        <div id="btnFinalizar">
            <button class="btn btn-light p-1 mr-3 pt-3 pb-3"><strong>Finalizar Venda</strong></button>
        </div>
        <div id="btnCancelar">
            <button class="btn btn-light p-1 pt-3 pb-3"><strong>Cancelar Venda</strong></button>
        </div>
    </div>
</div> 
<div class="row mt-2">
    <div class="col-md-8" id="display-tableApi">
        <table id="tableApi" style="cursor: pointer;"  class="moverProduto table p-5 hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Código</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Custo</th>
                    <th scope="col">Estoque</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col-md-8" id="display-tableVenda">
        <table id="tableVenda" style="cursor: default;"   class="table hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
                    <th style="width: 1%" class="removeLinha" scope="col">Item</th>
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Código</th>
                    <th style="width: 5%" scope="col">UN</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Total</th>
                    <th style="width: 5%;" scope="col">Deletar</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="col-md-4">
        <div class="row ">
            <div class="col-md-12 p-3 mb-3 cor-linha text-light" style="height: 75vh;">
                <div class="p-4">
                    <h1><strong>TOTAL</strong></h1>
                    <h1><strong id="total" class="pl-5 ml-5">0,00</strong></h1>
                </div>
                <div class="p-4">
                    <h1><strong id="troco">TROCO</strong></h1>
                    <h1><strong class="pl-5 ml-5">0,00</strong></h1>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script src="{{asset('assets/js/vendas.js')}}"></script>
<script>
    $('#btnFinalizar').on('click', function () {
        $('#modalFinalizarVenda').modal('show');
            setTimeout(function() {
                $('#valor_recebido').focus();
            }, 500);
        });
    $('#btnCancelar').on('click', function () {
        $('#modalAlert').modal('show');
        $('.modal-title').text('Cancelamento de venda');
        $('#title-body').text('Deseja cancelar a venda?');
        $('.btn-cancelar').text('Cancelar');
        $('#btnSubmit').text('Excluir todos itens');
    }); _token: $('meta[name="csrf-token"]').attr('content')
    $('#btnSubmit').on('click', function () {

        $.post('/vender/vendaAndamento/cancelarVenda',{_token: $('meta[name="csrf-token"]').attr('content')}, function (data) {
            location.reload();
        });
    })

</script>
@stop