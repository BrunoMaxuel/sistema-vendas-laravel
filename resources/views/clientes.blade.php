@extends('adminlte::page')

@section('title', 'Clientes Cadastrados')
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
    <div class="row pb-3">
        <div class="col-md-12">
            <h2>Total de Clientes <i class="fas fa-sm fa-arrow-right" style="margin-left:20px; width: 50px;"></i> <strong>{{count($clientes)}}</strong> </h2>
        </div>
        <div class="col-md-4">
            <input type="text" id="pesquisa" class="pesquisa" placeholder="Pesquisar clientes" name="query">
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

    <!-- Modal editar dados -->
    <x-modals.modalEditarCliente/>
    {{-- Modal excluir --}}
    <x-modals.modalExcluir/>
    {{-- Exibição de mensagem apos excluir ou alterar --}}
    <x-modals.modalMsg/>
    {{-- Tabela de clientes --}}
    <x-listaCliente :clientes="$clientes"/>
@stop

@section('js')
    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#tel').mask('(00) 00000-0000');
            $('#btnAdd').click(function() {
                $("#formUp")[0].reset();
                const rota = "{{route('cliente.adicionar')}}";
                $('#formUp').attr('action', rota);
                $('#modalAlert').modal('show');
            });

            $('.btnEditar').click(function() {
                $("#formUp")[0].reset();
                const rota = "{{route('cliente.editar')}}"
                $('#formUp').attr('action', rota);
                var linha = $(this).closest('tr');
                $('#id').val($(this).attr('id'));
                $('#nome').val(linha.find('td:eq(0)').text());
                $('#endereco').val(linha.find('td:eq(1)').text());
                $('#tel').val(linha.find('td:eq(2)').text());
                $('#bairro').val(linha.find('td:eq(3)').text());
                $('#cidade').val(linha.find('td:eq(4)').text());
                $('#modalAlert').modal('show');
            });

            
            $('.btnExcluir').click(function () {
                $('#idExcluir').val($(this).attr('id')); 
                const rota = "{{ route('cliente.excluir') }}";
                $('#formExcluir').attr('action', rota);
                $('#modalExcluir').modal('show');
            }); 

            var tabela = $('#table-cliente');
            var numCliente = tabela.find('tbody').find('tr').length;
            if(numCliente > 7){
                tabela.parent().css('max-height', '400px').css('overflow-y', 'auto');
            }
            else{
                table.parent().css('max-height', 'none').css('overflow-y', 'visible');    
            }

            $('#pesquisa').on('keyup', function(e) {
                var search = $(this).val();
                $.post("/clientes/pesquisar", {query: search, _token: $('meta[name="csrf-token"]').attr('content') }, function(clientes) {
                    $('#table-cliente tbody').empty();
                    if (clientes.length > 0) {
                        $.each(clientes, function (index, cliente) {
                            var linha = $('<tr>');
                            linha.append('<th scope="row">' + cliente.id + '</th>');
                            linha.append('<td><strong>' + cliente.nome + '</strong></td>');
                            linha.append('<td>' + cliente.endereco + '</td>');
                            linha.append('<td>' + cliente.telefone + '</td>');
                            linha.append('<td>' + cliente.bairro + '</td>');
                            linha.append('<td>' + cliente.cidade + '</td>');
                            linha.append('<td><div class="btn-group"> <div><button type="button" id="' + cliente.id + '" class="btnEditar btn btn-secondary btn-success mr-2"><i class="fas fa-edit"></i> </button></div><div><button type="button" id="' + cliente.id + '" class="btnExcluir btn btn-danger mt-2 mt-sm-0"><i class="fas fa-trash"></i> </button></div></div></td>');
                            // Adicionar linha à tabela
                            tabela.append(linha);
                        });
                    } else {
                        // Adicionar uma linha indicando que nenhum cliente foi encontrado
                        tabela.append('<tr><td colspan="8" class="text-center">Nenhum usuário encontrado</td></tr>');
                    }
                });
            });
        });
    </script>
@stop