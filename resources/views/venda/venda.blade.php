@extends('adminlte::page')
@section('title', 'Realizar venda')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables.min.css') }}"/>
<style>
	#search{
		margin-left: 15px;
		margin-bottom: 15px;
		width: 350px;
		height: 35px;
		font-size: 17px;
        border-radius: 5px;
	}
    #display-tableApi{
        display: none;
    }
    .cor-linha{
        background-color: #0A8DC6; 
        border-radius: 10px;
    }
    #tableApi tbody tr {
        padding: 2px; 

    }
    .custom-table {
        border-collapse: collapse;
        width: 100%;
        cursor: pointer;
    }

    .custom-table th,
    .custom-table td {
        padding: 4px; /* Ajuste o valor conforme necessário */
        text-align: left;
        border-bottom: 1px solid #ddd; /* Adicione uma borda inferior para separar as linhas */
    }


</style>
@stop
@section('content_header')
<div class="row p-2 cor-linha">
    <div class="col-md-8 cor-linha">
        <h5 class="text-light" style="margin-left: 17px">Código barras/Nome</h5>
        <div class="input-group-append search-input">
            <input type="text" id="search" placeholder="Pesquisar item para venda" oninput="convertToUpper(this)">
        </div>
    </div>
    <div class="col-md-4 cor-linha d-flex align-items-center justify-content-center">
        <div id="btnFinalizar">
            <button class="btn btn-light mr-2 "><strong>Finalizar Venda</strong></button>
        </div>
        <div id="btnCancelar">
            <button class="btn btn-light "><strong>Cancelar Venda</strong></button>
        </div>
    </div>
</div> 
@stop
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<x-modalMsg.modalVenda/>
<x-modalMsg.modal/>
<div class="row">
    <div class="col-md-9" id="display-tableApi">
        <table id="tableApi"  class="custom-table moverProduto table hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Código barras</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Custo</th>
                    <th scope="col">Estoque</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col-md-9" id="display-tableVenda">
        <table id="tableVenda" style="cursor: default;"   class="custom-table table hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
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
    <div class="col-md-3">
        <div class="row ">
            <div class="col-md-12 cor-linha text-light" style="height: 63vh;">
                <div class="p-3">
                    <h2><strong>TOTAL</strong></h2>
                    <h2><strong id="total" class="pl-3 ml-3">0,00</strong></h2>
                </div>
                <div class="p-3">
                    <h2><strong >Itens</strong></h2>
                    <h2><strong id="total_itens" class="pl-3 ml-3">0</strong></h2>
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