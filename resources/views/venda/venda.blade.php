@extends('adminlte::page')
@section('title', 'Realizar venda')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables.min.css') }}"/>
<style>
	#search{
		margin-left: 15px;
		margin-bottom: 15px;
		width: 350px;
		height: 40px;
		font-size: 25px;
	}
    #display-tableApi{
        display: none;
    }
	.custom-dialog {
		display: none;
		background-color: #222D32;
		position: fixed;
		width: 500px;
		height: 250px;
		color: white;
		top: 50%;
		left: 50%;
		text-align: center;
		transform: translate(-50%, -50%);
		padding: 30px;
		z-index: 999;
	}
	#confirm-button, #cancel-button{
		color: #1A2226;
		background-color: white;
		padding: 10px;
		font-size: 20px;
		border-radius: 5px;
		margin: 30px;
	}
</style>
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
	<div class="custom-dialog" id="confirmation-dialog">
		<div class="conteudo">
			<h3>Venda em andamento, deseja <strong>Cancelar</strong> a venda?</h3>
			<button id="confirm-button">Confirmar</button>
			<button id="cancel-button" autofocus>Cancelar</button>
		</div>
	</div>
</div>
<div class="col-md-12">
    <h4 style="margin-left: 15px">Código barras/Nome</h4>
</div>
    <div class="search-input col-md-12">
        <input type="text" id="search" placeholder="Pesquisar item para venda" oninput="convertToUpper(this)">
    </div>
</div>
<div class="row m-2">
    <div class="col-md-12" id="display-tableApi">
        <table id="tableApi" style="cursor: pointer;"  class="moverProduto table hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Código</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Preço Custo</th>
                    <th scope="col">Estoque</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col-md-12" id="display-tableVenda">
        <table id="tableVenda" style="cursor: default;"  class="table hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do produto</th>
                <th scope="col">Código</th>
                <th scope="col">Preço</th>
                <th scope="col">Preço Custo</th>
                <th scope="col">Estoque</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@stop
@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script type="text/javascript">

$('#tableApi tbody').on('mouseover', 'tr', function() {
    $(this).css('background-color', 'blue');
});

$('#tableApi tbody').on('mouseout', 'tr', function() {
    $(this).css('background-color', ''); // Remove o estilo para voltar ao padrão
});

// $('#search').on('keydown', function(e) {
//     var keyCode = e.keyCode || e.which;

//     // Se a tecla para cima for pressionada
//     if (keyCode === 38) {
//         e.preventDefault(); // Previne o comportamento padrão da tecla
//         var selected = $('.selected');

//         if (selected.length > 0) {
//             var prevRow = selected.prev('tr');
//             if (prevRow.length > 0) {
//                 selected.removeClass('selected');
//                 prevRow.addClass('selected');
//             }
//         }
//     }

//     // Se a tecla para baixo for pressionada
//     if (keyCode === 40) {
//         e.preventDefault(); // Previne o comportamento padrão da tecla
//         var selected = $('.selected');

//         if (selected.length > 0) {
//             var nextRow = selected.next('tr');
//             if (nextRow.length > 0) {
//                 selected.removeClass('selected');
//                 nextRow.addClass('selected');
//             }
//         } else {
//             // Se não houver linha selecionada, seleciona a primeira linha
//             $('tr:first').addClass('selected');
//         }
//     }
// });









    function convertToUpper(el) {
        $(el).val($(el).val().toUpperCase());
    }
    var inputSearch = $('#search');
    inputSearch.focus();
    var tableVenda = $('#tableVenda');
    var tableApi = $('#tableApi');

    $(function() {
    $('#tableApi tbody').on('click', 'tr', function() {
        var selectedRow = $(this); // Captura a linha clicada na tabela tableApi

        if (selectedRow.hasClass('selected')) {
            selectedRow.removeClass('selected'); // Remove a classe 'selected' se a linha já estiver selecionada
        } else {
            $('#tableApi tbody tr.selected').removeClass('selected'); // Remove a classe 'selected' de qualquer outra linha selecionada
            selectedRow.addClass('selected'); // Adiciona a classe 'selected' à linha clicada
        }

        var rowData = selectedRow.find('td'); // Obtém as células da linha clicada

        var newRow = $('<tr>'); // Cria uma nova linha para a tabela tableVenda
        for (var i = 0; i < rowData.length; i++) {
            var newCell = $('<td>'); // Cria uma nova célula
            newCell.text($(rowData[i]).text()); // Define o texto da nova célula com base no texto da célula clicada
            newRow.append(newCell); // Adiciona a nova célula à nova linha
        }

        $('#tableVenda').append(newRow); // Adiciona a nova linha à tabela tableVenda
        $('#display-tableApi').css('display', 'none');
        $('#display-tableVenda').css('display', 'block');
        $('#search').val('');
        inputSearch.focus();

    });
});


    $(function() {
        $('#search').on('keyup', function() {
            var search = $('#search').val();

            if (search) {
                //faz uma requisição post para a rota e ela retorna um array de objeto
                $.post("{{route('estoque.api.listar')}}", { search, _token: $('meta[name="csrf-token"]').attr('content') }, function (data){
                    //limpa antes de inserir novos registro
                    $('#tableApi tbody').empty();
                    //preenche dados
                    data.forEach(function(data) {
                        var newRow = $('<tr>');
                            newRow.append('<td>' + data.id + '</td>');
                            newRow.append('<td>' + data.nome + '</td>');
                            newRow.append('<td>' + data.codigo_barras + '</td>');
                            newRow.append('<td>' + data.preco + '</td>');
                            newRow.append('<td>' + data.preco_custo + '</td>');
                            newRow.append('<td>' + data.estoque + '</td>');
                            $('#tableApi tbody').append(newRow);
                        });
                    });
                    $('#display-tableApi').css('display', 'block');
                    $('#display-tableVenda').css('display', 'none');
            } else {
                $('#tableApi tbody').empty();
                $('#display-tableApi').css('display', 'none');
                $('#display-tableVenda').css('display', 'block');
            }
          
        });
    
        $('#tableApi').on( 'click', 'tr', function () {
            
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                tableApi.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
});
</script>
@stop