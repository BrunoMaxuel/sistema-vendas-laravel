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
        border-radius: 5px;
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
        border-radius: 10px;
		top: 50%;
		left: 50%;
		text-align: center;
		transform: translate(-50%, -50%);
		padding: 30px;
		z-index: 999;
	}
	#btnConfirmUpdate, #btnCancel{
		color: #1A2226;
		background-color: white;
		padding: 10px;
		font-size: 20px;
		border-radius: 5px;
		margin: 30px;
	}
    .cor-linha{
        background-color: #28A745; 
        border-radius: 10px;
    }
    .customize{
        border-radius: 10px;
        background-color: #6c757d;
    }
</style>
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
	<div class="custom-dialog" id="confirmation-dialog">
		<div class="conteudo">
			<h3>Venda em andamento, deseja <strong>Cancelar</strong> a venda?</h3>
			<button id="btnConfirmUpdate">Confirmar</button>
			<button id="btnCancel" autofocus>Cancelar</button>
		</div>
	</div>
</div>
<div class="row  customize ">
    <div class="col-md-6 p-2 cor-linha">
        <h4 class="text-light" style="margin-left: 17px">Código barras/Nome</h4>
        <div class="input-group-append search-input">
            <input type="text" id="search" placeholder="Pesquisar item para venda" oninput="convertToUpper(this)">
        </div>
    </div>
    <div  class="col-md-2 d-flex justify-content-center align-items-center">
        <button class="btn btn-success pt-3 pb-3"><strong>Buscar Cliente</strong></button>
    </div>
    <div  class="col-md-2 d-flex justify-content-center align-items-center">
        <button class="btn btn-success pt-3 pb-3"><strong>Cancelar Venda</strong></button>
    </div>
    <div  class="col-md-2 d-flex justify-content-center align-items-center">
        <button class="btn btn-success pt-3 pb-3"><strong>Finalizar Venda</strong></button>
    </div>
</div> 
<div class="row">
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
        <table id="tableVenda" style="cursor: default;"   class="table hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
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

    $('#tableApi tbody').on('mouseover mouseout', 'tr', function(event) {
        if (event.type === 'mouseover') {
            $(this).css('background-color', '#aaa');
        } else {
            $(this).css('background-color', '');
        }
    });
    function convertToUpper(el) {
        $(el).val($(el).val().toUpperCase());
    }
    
    var inputSearch = $('#search');
    inputSearch.focus();
    var tableVenda = $('#tableVenda');
    var tableApi = $('#tableApi');

    $(function() {
        tableApi.on('click', 'tr', function() {
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
            tableVenda.append(newRow); // Adiciona a nova linha à tabela tableVenda
            $('#display-tableApi').css('display', 'none');  //esconde a tabela de api
            $('#display-tableVenda').css('display', 'block'); //mostra a tabela de venda
            $('#search').val(''); //esvazia o compo de pesquisa
            inputSearch.focus(); //coloca o campo com foco
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
                            tableApi.append(newRow);
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

    $(document).on('keydown', function(e) {
        var tableApi = $('#tableApi');
        var rowCount = tableApi.find('tr').length;
        var code = e.which || e.keyCode;
        var preventKeys = [112, 113, 114, 115, 117, 118, 119, 120, 121, 123];
        if ($.inArray(code, preventKeys) !== -1 || (rowCount > 1 && code === 116)) {
            e.preventDefault();
            if (rowCount > 1 && code === 116) {
                $('#confirmation-dialog').css('display', 'block');
                $('#btnCancel').focus();
            }
        }
    });

    $('#btnCancel').click(function() {
        $('#confirmation-dialog').css('display', 'none');
        inputSearch.focus();
    });
    $('#btnConfirmUpdate').click(function() {
        location.reload();
    });

    //enviar dados para salvar
    $(function() {
    $('#seuBotaoDeEnvio').on('click', function() { // Substitua 'seuBotaoDeEnvio' pelo ID do seu botão de envio
        var tableData = [];

        $('#tableVenda tbody tr').each(function() {
            var rowData = {};
            $(this).find('td').each(function(index) {
                rowData['coluna' + index] = $(this).text(); // Ou você pode usar os nomes das colunas se tiver
            });
            tableData.push(rowData);
        });

        // Envia os dados para uma rota utilizando AJAX
        $.ajax({
            url: 'sua_rota_aqui', // Substitua 'sua_rota_aqui' pela URL de sua rota
            method: 'POST', // Ou 'GET' se for apropriado para o seu caso
            data: { tableData: tableData }, // Envia os dados como um objeto
            success: function(response) {
                // Sucesso - faça algo com a resposta do backend, se necessário
            },
            error: function(error) {
                // Tratamento de erro, se houver
            }
        });
    });
});

</script>
@stop