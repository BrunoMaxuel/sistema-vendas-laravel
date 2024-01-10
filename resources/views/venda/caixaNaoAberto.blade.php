@extends('adminlte::page')
@section('title', 'Realizar venda')

@section('content')
<x-modals.modalExcluir/>

@stop
@section('js')
<script src="{{asset('assets/js/vendas.js')}}"></script>
<script>
   
   $(function () {
    $(function () {
        $('#modalAlert .modal-dialog').addClass('modal-lg'); 
        $('')
    });

    $('#modalExcluir').modal({
        backdrop: 'static', // Configuração para o backdrop estático
        keyboard: false // Opcional: desabilita o fechamento do modal ao pressionar a tecla Escape
    });

    // Definir textos ou outras configurações do modal
    $('#titulo').text('O caixa está fechado');
    $('#corpo').text('Abra o caixa para realizar vendas');
    $('#btnModalCancelar').text('Página inicial');
    $('#btnModalExcluir').text('Prosseguir para abertura');
    $('#btnModalExcluir').addClass('bg-success border');
    $('#btnModalExcluir').on('click', function(evento) {
        event.preventDefault();
        window.location.href = '/caixa';
    });
    $('#btnModalCancelar').on('click', function(evento) {
        event.preventDefault();
        window.location.href = '/';
    });
});

</script>
@stop