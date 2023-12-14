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
	.custom-dialog {
		display: none;
		background-color: #222D32;
		position: fixed;
		width: 500px;
		height: 250px;
		color: white;
        border-radius: 10px;
		top: 50%;
		left: 50%;
		text-align: center;
		transform: translate(-50%, -50%);
		padding: 30px;
		z-index: 999;
	}
	#btnConfirmUpdate, #btnCancel{
		color: #1A2226;
		background-color: white;
		padding: 10px;
		font-size: 20px;
		border-radius: 5px;
		margin: 30px;
	}
    .cor-linha{
        background-color: #17A2B8; 
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
<div class="row">
	<div class="custom-dialog" id="confirmation-dialog">
		<div class="conteudo">
			<h3>Venda em andamento, deseja <strong>Cancelar</strong> a venda?</h3>
			<button id="btnConfirmUpdate">Confirmar</button>
			<button id="btnCancel" autofocus>Cancelar</button>
		</div>
	</div>
</div>
<div class="row ">
    <div class="col-md-6 p-2 cor-linha">
        <h4 class="text-light" style="margin-left: 17px">Código barras/Nome</h4>
        <div class="input-group-append search-input">
            <input type="text" id="search" placeholder="Pesquisar item para venda" oninput="convertToUpper(this)">
        </div>
    </div>
    <div  class="col-md-2 d-flex justify-content-center align-items-center">
        <button class="btn btn-info pt-3 pb-3"><strong>Buscar Cliente</strong></button>
    </div>
    <div  class="col-md-2 d-flex justify-content-center align-items-center">
        <button class="btn btn-info pt-3 pb-3"><strong>Cancelar Venda</strong></button>
    </div>
    <div id="finalizarVenda" class="col-md-2 d-flex justify-content-center align-items-center">
        <button class="btn btn-info pt-3 pb-3"><strong>Finalizar Venda</strong></button>
    </div>
</div> 
<div class="row">
    <div class="col-md-8" id="display-tableApi">
        <table id="tableApi" style="cursor: pointer;"  class="moverProduto table p-5 hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Código</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Preço Custo</th>
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
                </tr>
            </thead>
        </table>
    </div>
    <div class="col-md-4">
        <div class="bg-info p-5 cor-linha">
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

@stop
@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script src="{{asset('assets/js/vendas.js')}}"></script>
@stop