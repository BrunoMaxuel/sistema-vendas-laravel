@extends('adminlte::page')

@section('title', 'Produtos Adicionados')
@section('css')
    <style>
        .cor-fundo{
            background-color: #0A8DC6;
            padding: 20px 10px 20px 10px;
            border-radius: 10px;
            color:white;
        }
        tbody tr td{
       text-transform: uppercase;
        }
    </style>
@stop
@section('content_header')
    <div class="row cor-fundo">
        <div class="col-md-4">
            <form action="{{ route('produtos.search') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Pesquisar por produtos" name="query">
                    <div class="input-group-append">
                        <button style="border: solid 1px rgb(0, 0, 0); color: black; background-color:white;" class="btn btn-outline-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-5">
            <h3>TOTAL DE PRODUTOS  <i class="fas fa-sm fa-arrow-right" style="width: 50px;"></i> <strong>{{count($produtos)}}</strong> </h3>
        </div>
        <div class="col-md-3 d-flex justify-content-end align-items-center">
            <div id="btnAdd" class="btn btn-light">
                Adicionar produto
            </div>
        </div>
    </div>
@stop


@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Modal -->
<x-produto.modalExcluir/>
<x-produto.modalEdit/>
<x-modalMsg.modalMsg/>

<x-produto.listProduto :produtos="$produtos"/>
@stop
@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
  <script type="text/javascript">
    $(function() {
        $('#btnAdd').click(function() {
            $("#formUp")[0].reset();
            $('#modalAlert').modal('show');
        });

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

            var newPreco = mCusto + (mCusto * (mLucro / 100));
            preco.val(preco.masked(newPreco.toFixed(2)));
           
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
              $("#categoria").val(data.categoria);
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
            $.post("{{route('produtos.excluir')}}", { id: idExcluir, _token: $('meta[name="csrf-token"]').attr('content') }, function (data) {
                $("#idExcluir").val(data.id); 
            });
            $('#modalExcluir').modal('show');
        }

        $('#btnModalExcluir').click(function () {
            var idExcluir = $('#idExcluir').val();
            $.post("{{route('produtos.excluir.action')}}", { id: idExcluir, _token: $('meta[name="csrf-token"]').attr('content') }, function (data){
                if(data.success === true){
                    $('#modalExcluir').modal('hide');
                    $("#background-text").addClass("bg-success");
                    $("#titulo-msg").html("Cliente excluido com sucesso!");
                    $('#modal-msg').modal('show');
                    setTimeout(function() {
                            window.location.reload(); 
                    }, 1100); 
                }
                else{
                    $("#background-text").addClass("modal-header alert alert-danger");
                    $("#titulo-msg").html("Erro ao excluir cliente!");
                }
          });
      });

      var tabela = $('#tabela-produto');
        var numTabela = tabela.find('tbody').find('tr').length;
        if(numTabela > 7){
            tabela.parent().css('max-height', '400px').css('overflow-y', 'auto');
        }
        else{
            tabela.parent().css('max-height', 'none').css('overflow-y', 'visible');    
        }
  });
  </script>
@stop