@extends('adminlte::page')

@section('title', 'Clientes Cadastrados')
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
    <div class="row cor-fundo">
        <div class="col-md-4">
            <form action="{{ route('clientes.search') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Pesquisar clientes" name="query">
                    <div class="input-group-append">
                        <button style="border: solid 1px rgb(0, 0, 0); color: black; background-color:white;" class="btn btn-outline-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-5">
            <h3>TOTAL DE CLIENTES  <i class="fas fa-sm fa-arrow-right" style="width: 50px;"></i> <strong>{{count($clientes)}}</strong> </h3>
        </div>
        <div class="col-md-3 d-flex justify-content-end align-items-center">
            <div>
                <x-form.button id="btnAdd" type="submit" theme="light" icon="fas fa-icon-name" label="Adicionar Cliente" />
            </div>
        </div>
    </div>
@stop

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Modal dados -->

    <x-cliente.modalEdit/>

    {{-- Modal excluir --}}
    <x-cliente.modalExcluir/>


    {{-- Exibição de mensagem apos excluir ou alterar --}}
    <x-modalMsg.modalMsg/>
    {{-- Tabela de clientes --}}
    <x-cliente.listaCliente :clientes="$clientes"/>
@stop

@section('js')
    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#tel').mask('(00) 00000-0000');
            $('#btnAdd').click(function() {
                $("#formUp")[0].reset();
                $('#modalAlert').modal('show');
            });

            $('.btnEditar').click(function() {
                $("#formUp")[0].reset();
                editar($(this).attr('id'));
            });
            function editar(index){
                $.post("{{route('clientes.editar')}}", { id: index, _token: $('meta[name="csrf-token"]').attr('content')}, function( data )	
                {
                    $("#id").val(data.id);
                    $("#nome").val(data.nome);
                    $("#tel").val(data.telefone);
                    $("#endereco").val(data.endereco);
                    $("#bairro").val(data.bairro);
                    $("#cidade").val(data.cidade);
                }
                );

                $('#modalAlert').modal('show');
            };

            $('#btnSubmit').click(function() {
                var dados = $("#formUp").serialize();
                $.post("{{route('clientes.saveEdit')}}",dados, function( data )	{
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
                        if(data.errors.hasOwnProperty('nome')) 
                        {
                            var errorMessage = data.errors.nome[0];
                            $('#error-nome').text(errorMessage);
                        }
                    }
                });
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
                        $("#background-text").addClass("bg-success");
                        $("#titulo-msg").html("Cliente excluido com sucesso!");
                        $('#modal-msg').modal('show');
                        $('#modalExcluir').modal('hide');
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

            var tabela = $('#table-cliente');
            var numCliente = tabela.find('tbody').find('tr').length;
            if(numCliente > 7){
                tabela.parent().css('max-height', '400px').css('overflow-y', 'auto');
            }
            else{
                table.parent().css('max-height', 'none').css('overflow-y', 'visible');    
            }
        });
    </script>
@stop