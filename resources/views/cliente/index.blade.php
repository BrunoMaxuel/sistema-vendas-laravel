@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
<div>
    <h3>Total de clientes: {{$clientes->total()  }} </h3>
</div>
<div id="btnAdd" class="btn btn-success m-1">
    Adicionar Cliente
</div>
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Modal dados -->

<x-cliente.modalEdit/>

{{-- Modal excluir --}}
<x-cliente.modalExcluir/>

{{-- Exibição de mensagem apos excluir ou alterar --}}
<x-cliente.msgReturn/>
{{-- Tabela de clientes --}}
<x-cliente.listaCliente :clientes="$clientes"/>
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
            $.post("{{route('clientes.editar')}}", { id: index, _token: $('meta[name="csrf-token"]').attr('content')}, function( data )	{
              $("#id").val(data.id);
              $("#nome").val(data.nome);
              $("#sexo").val(data.sexo);
              $("#tel1").val(data.telefone);
              $("#endereco").val(data.endereco);
              $("#bairro").val(data.bairro);
              $("#cidade").val(data.cidade);
              $("#uf").val(data.estado);
            }
        );


        $('#modalAlert').modal('show');

        };


        
    
        $('#btnSubmit').click(function() {
            var dados = $("#formUp").serialize();
            $.post("{{route('clientes.saveEdit')}}",dados, function( data )	{
                $('#modalAlert').modal('hide');
                if(data.success == true){
                    $("#background-text").addClass("bg-success");
                    $("#titulo-msg").html(data.message);
                    $('#modal-msg').modal('show');
                    setTimeout(function() {
                        window.location.reload(); 
                    }, 1100); 
                }
                else{
                    $("#background-text").addClass("modal-header alert alert-danger");
                    $("#titulo-msg").html("Erro ao alterar cliente!");
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