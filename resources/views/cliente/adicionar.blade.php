@extends('adminlte::page')

@section('title', 'Adicionar Cliente')

@section('content_header')
    <div class="m-3">
        <h1>Adicionar Cliente</h1>
    </div>
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Exibição de mensagem apos excluir ou alterar ou adicionar--}}
<x-cliente.msgReturn/>

    <div class="row ml-2">
        <div class="col-md-6">
            <form id="formUp">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="nome">Nome do cliente<span class="text-danger">*</label>
                    <input type="text" id="nome" maxlength="40" required="required" name="nome" class="form-control" placeholder="Nome">
                    <span id="error-nome" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" id="endereco" name="endereco" maxlength="40" class="form-control" placeholder="Ex. Rua Brasil 999">
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="tel" name="telefone" class="form-control" placeholder="Telefone">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" maxlength="30" name="cidade" class="form-control" placeholder="Cidade">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" maxlength="30" name="bairro" class="form-control" placeholder="Bairro">
                    </div>
                </div>
                <button type="button" id="btnSubmit" class="btn btn-success mt-2">
                    Salvar Cliente
                </button>
            </form>
        </div>
    </div>
@stop
@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script type="text/javascript">
$(function() {
    $('#tel').mask('(00) 00000-0000');
    
    $('#formUp').on('keyup keypress', function(e) {
  	  var keyCode = e.keyCode || e.which;
  	  if (keyCode === 13) { 
  	    e.preventDefault();
  	    return false;
  	  }
  	});
      $('#btnSubmit').click(function() {
            var dados = $("#formUp").serialize();
            $.post("{{route('clientes.adicionar.action')}}",dados, function( data )	{
                    if(data.success == true){
                        $("#background-text").addClass("bg-success");
                        $("#titulo-msg").html("Cliente adicionado com sucesso!");
                        $('#modal-msg').modal('show');
                        setTimeout(function() {
                            window.location.reload(); 
                        }, 1000); 
                    }
                    else{
                        if(data.errors.hasOwnProperty('nome')) {
                        // Exibe a mensagem de erro ao lado do campo 'nome'
                        var errorMessage = data.errors.nome[0];
                        $('#error-nome').text(errorMessage);
                    }
                }
              }
            );
        });
 });
</script>
@stop

