@extends('adminlte::page')
@section('title', 'Realizar venda')
@push('css')
    <style>
        #search{
            margin-left: 1px;
            margin-bottom: 10px;
            width: 350px;
            height: 40px;
            font-size: 17px;
        }
        .hidden{
            display: none;
        }
    </style>
@endpush
@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h5 class="text-light @if (session('msg')) msg @endif  " style="margin-left: 5px">Código barras/Nome</h5>
            <div class="input-group-append search-input">
                <input type="text" id="search" name="pesquisa" placeholder="Pesquisar item para venda" oninput="convertToUpper(this) ">
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-end pr-4">
            <div id="btnFinalizar">
                <button class="btn btn-light mr-3 "><strong>Finalizar Venda</strong></button>
            </div>
            <div id="btnCancelar">
                <button class="btn btn-light "><strong>Cancelar Venda</strong></button>
            </div>
        </div>
    </div> 
@stop
@section('content')
<x-modals.modalVenda/>
<x-modals.modalMsg/>

<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="display-tableApi" class="hidden">
    <table class="table-api moverProduto table hover order-column table-striped compact table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do produto</th>
                <th scope="col">Código barras</th>
                <th scope="col">Custo</th>
                <th scope="col">Preço</th>
                <th scope="col">Estoque</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="row info-venda">
    <div class="col-md-9" id="display-tableVenda">
        <table class="table-venda table hover order-column table-striped compact table-bordered" >
            <thead class="thead-light">
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Código</th>
                    <th style="width: 5%" scope="col">UN</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="col-md-3 d-flex flex-column align-items-center">
        <div class="mb-5">
            <h1><strong>TOTAL</strong></h1>
            <h2><strong class="total_valor_venda pl-3 ml-3">0,00</strong></h2>
        </div>
        <div class="mt-3">
            <h1><strong >Itens</strong></h1>
            <h2><strong class="total_item_venda pl-3 ml-3">0</strong></h2>
        </div>
    </div>
</div>

@stop
@push('js')
    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script src="{{asset('assets/js/vendas.js')}}"></script>

    <script>
        $(function() {
			if ($('.msg').text()) {
				showModal();
				function showModal(){
					$("#background-text").addClass("bg-success");
					$("#titulo-msg").html("Venda realizada!");
					setTimeout(function() {
							$('#modal-msg').modal('show');
					}, 500); 
					setTimeout(function() {
                        $('#modal-msg').modal('hide');
					}, 1400); 
				}
			}
        });
        $('#btnCancelar').click(function(){
            const resp = window.confirm("Tem certeza que deseja cancelar todos produtos?");
            if(resp){
                localStorage.clear();
                location.reload();
            }
        });
        $('#display-tableApi').parent().css('height', '440px').css('overflow-y', 'hidden');
        
    </script>
@endpush