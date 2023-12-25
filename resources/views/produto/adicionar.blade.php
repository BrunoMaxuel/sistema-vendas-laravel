@extends('adminlte::page')
@section('title', 'Adicionar Produto')
@section('css')
    <style>
         .cor-fundo{
            background-color: #0A8DC6;
            padding: 20px 10px 20px 10px;
            border-radius: 10px;
            color:white;
        }
    </style>

@stop
@section('content_header')
    <div class="row ml-3">
        <div class="col-md-6 cor-fundo">
            <h5>Adicionar novo Produto</h5>
        </div>
    </div>
@stop
@section('content')
<x-modalMsg.modalMsg/>
<div class="row ml-2">
    <div class="col-md-6">
        <form id="formUp">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <label for="nome">Nome do produto <span class="text-danger">*</span></label>
                <input type="text" id="nome" maxlength="100" required="required" name="nome" class="form-control" placeholder="Nome do produto">
                <span id="error-nome" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="codigo_barras">Código de barras</label>
                <input type="text" id="codigo_barras" maxlength="13" name="codigo_barras" class="form-control" placeholder="Insira um código de barras">
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="preco_custo">Preço de custo<span class="text-danger">*</span></label>
                    <input type="text" id="preco_custo" name="preco_custo" class="form-control" placeholder="Qual o custo do produto...">
                    <span id="error-preco-custo" class="text-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="preco">Preço de venda<span class="text-danger">*</span></label>
                    <input type="text" id="preco" name="preco" class="form-control" placeholder="Preço de venda do produto...">
                    <span id="error-preco" class="text-danger"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="lucro">Lucro<span class="text-danger">*</span></label>
                    <input type="text" id="lucro" name="lucro" class="form-control">
                    <span id="error-lucro" class="text-danger"></span>
                </div>
                <div class="form-group col-md-3">
                    <label for="estoque">Estoque<span class="text-danger">*</span></label>
                    <input type="number" id="estoque" name="estoque" class="form-control">
                    <span id="error-estoque" class="text-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="fornecedor">Fornecedor</label>
                    <input type="text" id="fornecedor" name="fornecedor" class="form-control">
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select id="categoria" name="categoria" class="form-control">
                        <option value="Não selecionado" selected="selected">Selecione uma categoria</option>
                        <option value="Eletronico">Eletrônicos</option>
                        <option value="Cama mesa e banho">Cama, mesa e banho</option>
                        <option value="Artigos para presente">Artigos para presente</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <button type="button" id="btnSubmit" class="btn btn-primary">Salvar alterações</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
  <script type="text/javascript">
    $(function() {   
        $('#preco').mask('000.000,00', {reverse: true});
        $('#preco_custo').mask('000.000,00', {reverse: true});
        $('#lucro').mask('000%', {reverse: true});

        var preco = $('#preco');
    	var lucro = $('#lucro');
    	var custo = $('#preco_custo');
    	
    	$('#preco, #preco_custo').on('keyup', function() {
            var mCusto = parseFloat(custo.val().replace(".", "").replace(",", ".")) || 0;
            var mPreco = parseFloat(preco.val().replace(".", "").replace(",", ".")) || 0;
            var diff = mPreco - mCusto;
            lucro.val(lucro.masked(((diff / mCusto) * 100).toFixed(0)));
        });

        $('#lucro').on('keyup', function() {
            var mCusto = parseFloat(custo.val().replace(".", "").replace(",", ".")) || 0;
            var mLucro = parseFloat(lucro.cleanVal()) || 0;
            console.log($('#lucro').val(), $('#preco').val(),  $('#preco_custo').val());
            
            
            var newPreco = mCusto + (mCusto * (mLucro / 100));
            preco.val(preco.masked(newPreco.toFixed(2)));
           
        });

        $('#btnSubmit').click(function() {
            var dados = $("#formUp").serialize();
            $.post("{{route('produtos.saveEdit')}}",dados, function( data )	{
                if(data.success == true){
                    $("#background-text").addClass("bg-success");
                    $("#titulo-msg").html(data.message);
                    $('#modal-msg').modal('show');
                    setTimeout(function() {
                        window.location.reload(); 
                    }, 1100); 
                }
                else{
                if (data.errors.hasOwnProperty('nome')) {
                    // Exibe a mensagem de erro ao lado do campo 'nome'
                    var errorMessage = data.errors.nome[0];
                    $('#error-nome').text(errorMessage);
                }
                if (data.errors.hasOwnProperty('codigo_barras')) {
                    // Exibe a mensagem de erro ao lado do campo 'codigo_barras'
                    var errorMessage = data.errors.codigo_barras[0];
                    $('#error-cod-barras').text(errorMessage);
                }
                if (data.errors.hasOwnProperty('preco')) {
                    // Exibe a mensagem de erro ao lado do campo 'preco'
                    var errorMessage = data.errors.preco[0];
                    $('#error-preco').text(errorMessage);
                }
                if (data.errors.hasOwnProperty('preco_custo')) {
                    // Exibe a mensagem de erro ao lado do campo 'preco_custo'
                    var errorMessage = data.errors.preco_custo[0];
                    $('#error-preco-custo').text(errorMessage);
                }
                if (data.errors.hasOwnProperty('lucro')) {
                    // Exibe a mensagem de erro ao lado do campo 'preco_custo'
                    var errorMessage = data.errors.lucro[0];
                    $('#error-lucro').text(errorMessage);
                }
                if (data.errors.hasOwnProperty('estoque')) {
                    // Exibe a mensagem de erro ao lado do campo 'preco_custo'
                    var errorMessage = data.errors.estoque[0];
                    $('#error-estoque').text(errorMessage);
                }

                }
              }
            );
        });
  });
  </script>
@stop