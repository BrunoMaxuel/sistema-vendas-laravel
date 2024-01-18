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
        .custom-table {
        border-collapse: collapse;
        width: 100%;
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
<x-modals.modalExcluir/>
<x-modals.modalEditarProduto/>
<x-listaProduto :produtos="$produtos"/>
@stop
@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
  <script type="text/javascript">
    $(function() {
        var preco = $('#preco');
        var lucro = $('#lucro');
        var custo = $('#preco_custo');
        $('#btnAdd').click(function() {
            $("#formUp")[0].reset();
            $('#formUp').attr("action", "{{ route('produto.adicionar')}}")
            $('#modalAlert').modal('show');
        });

    	
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
            var linhaTabela = $(this).closest('tr');
            var colunas = linhaTabela.find('td');
            $('#id_hidden').val(colunas[0].innerText);
            $('#nome').val(colunas[1].innerText);
            $('#codigo_barras').val(colunas[2].innerText);
            $('#preco').val(colunas[3].innerText);
            $('#preco_custo').val(colunas[4].innerText);
            $('#categoria').val(colunas[8].innerText);
            $('#lucro').val(colunas[5].innerText);
            $('#estoque').val(colunas[6].innerText);
            $('#fornecedor').val(colunas[7].innerText);
            $('#modalAlert').modal('show');
            $("#formUp").attr("action", "{{ route('produto.editar') }}");
        });
            
        

        $('.btnExcluir').click(function () {
              $('#idExcluir').val($(this).attr('id')); 
              const rota = "{{route('produto.excluir')}}";
              $('#formExcluir').attr('action', rota);
              $('#modalExcluir').modal('show');
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