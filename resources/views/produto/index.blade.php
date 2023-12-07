@extends('adminlte::page')

@section('title', 'Produtos Cadastrados')
@section('css')
@section('content_header')
<div>
    <h3>Total de produtos: {{$produtos->total()  }} </h3>
</div>
<div id="btnAdd" class="btn btn-success m-1">
    Adicionar Produto
</div>
@stop
<style>
    tbody tr td{
   text-transform: uppercase;
    }
</style>
@stop

@section('content')

<form action="{{ route('produtos.search') }}" method="GET" class="form-inline">
	<div class="input-group">
		<input type="text" class="form-control" placeholder="Pesquisar produto..." name="query">
		<div class="input-group-append">
			<button class="btn btn-outline-secondary" type="submit">Buscar</button>
		</div>
	</div>
</form>

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Modal -->

<x-produto.modalEdit/>
<x-produto.msgReturn/>

<x-produto.listProduto :produtos="$produtos"/>
@stop
@section('js')
  <script type="text/javascript">
    $(function() {
        $('#btnAdd').click(function() {
            $("#formUp")[0].reset();
            $('#modalAlert').modal('show');
        });

        $('.btnEditar').click(function() {
            $("#formUp")[0].reset();
            editar($(this).attr('id'));
        });
        function editar(index){
            $.post("{{route('produtos.editar')}}", { id: index, _token: $('meta[name="csrf-token"]').attr('content')}, function( data )	{
              $("#id").val(data.id);
              $("#nome").val(data.nome);
              $("#codigo_barras").val(data.codigo_barras);
              $("#preco").val(data.preco);
              $("#preco_custo").val(data.preco_custo);
              $("#lucro").val(data.lucro);
              $("#fornecedor").val(data.fornecedor);
              $("#estoque").val(data.estoque);
            }
        );


        $('#modalAlert').modal('show');

        };


        
    
        $('#btnSubmit').click(function() {

            var dados = $("#formUp").serialize();
            $.post("{{route('produtos.saveEdit')}}",dados, function( data )	{
                

                if(data.success == true){
                    $('#modalAlert').modal('hide');
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
                // Adicione condições semelhantes para outros campos, se necessário

                }
              }
            );
        });

        $('.btnExcluir').click(function () {
              $("#formUpExcluir")[0].reset();
              excluir($(this).attr('id'));
        });
        function excluir(idExcluir) {
            $.post("{{route('clientes.excluir')}}", { id: idExcluir, _token: $('meta[name="csrf-token"]').attr('content') }, function (data) {
                $("#idExcluir").val(data.id); 
            });
            $('#modalExcluir').modal('show');
        }

        $('#btnModalExcluir').click(function () {
            var idExcluir = $('#idExcluir').val();
            $.post("{{route('clientes.excluirAction')}}", { id: idExcluir, _token: $('meta[name="csrf-token"]').attr('content') }, function (data){
                if(data.success === true){
                    $("#background-text").addClass("bg-danger");
                    $("#titulo-msg").html("Cliente excluido com sucesso!");
                    $('#modal-msg').modal('show');
                    setTimeout(function() {
                            $('#modal-msg').modal('hide');
                            window.location.reload(); 
                    }, 1100); 
                }
                else{
                    $("#background-text").addClass("modal-header alert alert-danger");
                    $("#titulo-msg").html("Erro ao excluir cliente!");
                }
                $('#modalExcluir').modal('hide');
          });
      });
  });
  </script>
@stop