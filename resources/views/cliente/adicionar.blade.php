@extends('adminlte::page')

@section('title', 'Adicionar Cliente')
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
<div class="row ml-3 mr-1">
    <div class="col-md-6 cor-fundo">
        <h5>Adicionar Cliente</h5>
    </div>
</div>
@stop

@section('content')

{{-- Exibição de mensagem apos excluir ou alterar ou adicionar--}}
<x-modals.modalMsg/>
<div class="row ml-2">
    <div class="col-md-6">
        <form id="formUp" method="POST">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <label for="nome">Nome do cliente<span class="text-danger">*</span></label>
                <input type="text" id="nome" maxlength="100" name="nome" class="form-control" placeholder="Nome">
                <span id="error-nome" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Ex: Rua Jose Armando de Lira">
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="tel" name="telefone" class="form-control" placeholder="Telefone">
                </div>
                <div class="form-group col-md-6">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade">
                </div>
            </div>
                <button id="btnSubmit" type="submit" class="btn btn-primary">Salvar alterações</button>
        </form>
    </div>
</div>
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

