@extends('adminlte::page')

@section('title', 'Produtos Adicionados')
@section('css')
    <style>
         .pesquisa{
            height: 40px ;
            width: 400px;
            border-radius: 5px;
        }
    </style>
@stop
@section('content_header')
    <div class="row pb-3 @if(session('msg')) msg  @endif">
        <div class="col-md-12">
            <h3>Total de Produtos  <i class="fas fa-sm fa-arrow-right" style="margin-left:20px; width: 50px;"></i> <strong>{{count($produtos)}}</strong> </h3>
        </div>
        <div class="col-md-4">
            <input id="search" type="text" class="pesquisa" placeholder="Pesquisar por produtos" name="query">
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
<x-modals.modalMsg/>
<x-listaProduto :produtos="$produtos"/>
@stop
@section('js')

<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            if ($('.msg').text()) {
				showModal();
				function showModal(){
					$("#background-text").addClass("bg-success");
					$("#titulo-msg").html("Operação realizada com sucesso!");
					setTimeout(function() {
							$('#modal-msg').modal('show');
					}, 400); 
					setTimeout(function() {
                        $('#modal-msg').modal('hide');
					}, 1500); 
				}
			}
            
            $(document).on('keydown', function(e){
                if(!$('#modalAlert').is(':visible')){
                    $('#search').focus();
                }
            });
            $('#btnAdd').click(function() {
                $("#formUp")[0].reset();
                $('#formUp').attr("action", "{{ route('produto.adicionar')}}")
                $('#modalAlert').modal('show');
            });

            $('#search').on('keyup', function (e) {
                var search = $(this).val();
                $.post('/produtos/search', {query: search, _token: $('meta[name="csrf-token"]').attr('content')}, function(produtos){
                    $('#tabela-produto tbody').empty();
                    if(produtos.length > 0){
                        $.each(produtos, function(index, produto){
                            var linha = $('<tr>');
                            linha.append('<td >'+ produto.id + '</td>');
                            linha.append('<td><strong>'+ produto.nome + '</strong></td>');
                            linha.append('<td>'+ produto.codigo_barras + '</td>');
                            linha.append('<td>'+ produto.preco + '</td>');
                            linha.append('<td>'+ produto.preco_custo + '</td>');
                            linha.append('<td>'+ produto.lucro + '</td>');
                            linha.append('<td>'+ produto.estoque + '</td>');
                            linha.append('<td>'+ produto.fornecedor + '</td>');
                            linha.append('<td>'+ produto.categoria + '</td>');
                            linha.append('<td><div class="btn-group"> <div><button type="button" id="' + produto.id + '" class="btnEditar btn btn-secondary btn-success mr-2"> <i class="fas fa-edit"></i> </button></div><div><button type="button" id="' + produto.id + '" class="btnExcluir btn btn-danger mt-2 mt-sm-0"><i class="fas fa-trash"></i></button></div></div></td>');
                            $('#tabela-produto').append(linha);
                        });
                    }else{
                        $('#tabela-produto').append('<tr><td colspan="10" class="text-center"><h2>Nenhum produto encontrado</h2></td></tr>');
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