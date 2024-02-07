@extends('adminlte::page')

@section('title', 'Produtos Adicionados')
@section('css')
    <style>
         .pesquisa{
            height: 40px ;
            width: 400px;
            border-radius: 5px;
        }

        tbody tr td{
            text-transform: uppercase;
        }

        .custom-table {
            border-collapse: collapse;
            width: 100%;
        }  
    </style>
@stop
@section('content_header')
    <div class="row pb-3">
        <div class="col-md-12">
            <h3>Total de Produtos  <i class="fas fa-sm fa-arrow-right" style="margin-left:20px; width: 50px;"></i> <strong>{{count($produtos)}}</strong> </h3>
        </div>
        <div class="col-md-4">
            <input type="text" class="pesquisa" placeholder="Pesquisar por produtos" name="query">
        </div>
        <div class="col-md-8 d-flex justify-content-end align-items-center">
            <div>
                <x-form.button id="btnAdd" type="submit" theme="light" icon="fas fa-icon-name" label="Adicionar Cliente" />
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