@extends('adminlte::page')
@section('title', 'Realizar venda')

@section('css')
<<<<<<< HEAD

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
    .custom-input {
		border: none; /* Remove a borda padrão */
		background-color: #0A8DC6; /* Cor de fundo */
		color: white; /* Cor do texto */
		font-size: 1.25rem; /* Tamanho da fonte */
		padding: 0.375rem 0.75rem; /* Espaçamento interno */
		margin-left: 1.25rem; /* Margem esquerda para alinhar ao texto */
		font-weight: bold; /* Negrito */
		width: 150px;
	}

</style>
=======
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

        .custom-input {
            border: none; /* Remove a borda padrão */
            background-color: #0A8DC6; /* Cor de fundo */
            color: white; /* Cor do texto */
            font-size: 1.25rem; /* Tamanho da fonte */
            padding: 0.375rem 0.75rem; /* Espaçamento interno */
            margin-left: 1.25rem; /* Margem esquerda para alinhar ao texto */
            font-weight: bold; /* Negrito */
            width: 150px;
        }
        #tableApi{
            max-height: 400px;
            overflow-y: auto; 
        }   
        #tableVenda{
            background-color: #0A8DC6;
            color: white;
            border-radius: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 10px; /* Adicione esta linha para arredondar os cantos da tabela */
            overflow: hidden; /* Garante que a borda arredondada seja visível mesmo com bordas internas */
        }

    </style>
>>>>>>> emergency
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
<x-modals.modalVenda/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-md-9" id="display-tableApi">
<<<<<<< HEAD
        <table id="tableApi"  class="custom-table moverProduto table hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
=======
        <table id="tableApi"  class="moverProduto table hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
>>>>>>> emergency
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
<<<<<<< HEAD
        <table id="tableVenda" style="cursor: default;"   class="custom-table table hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
=======
        <table id="tableVenda" class="table hover order-column table-striped compact table-bordered" width="100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Item</th>
>>>>>>> emergency
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Código</th>
                    <th style="width: 5%" scope="col">UN</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Total</th>
<<<<<<< HEAD
                    <th style="width: 5%;" scope="col">Deletar</th>
                </tr>
            </thead>
=======
                </tr>
            </thead>
            <tbody>

            </tbody>
>>>>>>> emergency
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
                    <h2><strong id="total_item" class="pl-3 ml-3">0</strong></h2>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('js')
    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script src="{{asset('assets/js/vendas.js')}}"></script>
@stop