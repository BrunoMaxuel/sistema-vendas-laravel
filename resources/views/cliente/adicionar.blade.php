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
        <div class="col-md-12">
            <form id="formUp">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="nome">Nome do cliente</label>
                    <input type="text" id="nome" maxlength="100" required="required" name="nome" class="form-control" placeholder="Nome">
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Ex. Rua Brasil 999">
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="tel1" name="telefone" class="form-control" placeholder="Telefone">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sexo">Sexo do cliente</label>
                        <select id="sexo" name="sexo" class="form-control">
                            <option value="I">Não especificado</option>
                            <option value="F">Feminino</option>
                            <option value="M">Masculino</option>
                        </select>
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
<script type="text/javascript">
$(function() {
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
                    $("#background-text").addClass("modal-header alert alert-danger");
                    $("#titulo-msg").html("Erro ao alterar cliente!");
                }
              }
            );
        });
 });
</script>
@stop

