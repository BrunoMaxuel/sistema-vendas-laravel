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
<x-modalMsg.modalVenda/>

<div class="row ">
    <div class="col-md-12 p-2 cor-linha">
        <h4 class="text-light" style="margin-left: 17px">Código barras/Nome</h4>
        <div class="input-group-append search-input">
            <input type="text" id="search" placeholder="Pesquisar item para venda" oninput="convertToUpper(this)">
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
        <div class="row">
            <div class="col-md-12 bg-info p-3 mb-3 cor-linha">
                <div class="p-4">
                    <h1><strong>TOTAL</strong></h1>
                    <h1><strong id="total" class="pl-5 ml-5">0,00</strong></h1>
                </div>
                <div class="p-4">
                    <h1><strong id="troco">TROCO</strong></h1>
                    <h1><strong class="pl-5 ml-5">0,00</strong></h1>
                </div>
            </div>
            <div class="col-md-12 bg-info p-3 cor-linha">
               <div class="row">
                    <div class="col-md-6">
                        <div id="btnFinalizar" class="mt-4 mb-4">
                            <button class="btn btn-light p-3"><strong>Finalizar Venda</strong></button>
                        </div>
                        <div class="mt-4 mb-4">
                            <button class="btn btn-light p-3"><strong>Cancelar Venda</strong></button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-4 mb-4">
                            <button class="btn btn-light p-3"><strong>Buscar Cliente</strong></button>
                        </div>
                        <div class="mt-4 mb-4">
                            <button class="btn btn-light p-3"><strong>Nova venda</strong></button>
                        </div>
                    </div>
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
    })
</script>
@stop