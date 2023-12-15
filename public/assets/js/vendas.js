// Efeito de linha na tabela
$('#tableApi tbody').on('mouseover mouseout', 'tr', function(event) {
    if (event.type === 'mouseover') {
        $(this).css('background-color', '#aaa');
    } else {
        $(this).css('background-color', '');
    }
});

// Converter para maiúsculo o input
function convertToUpper(el) {
    $(el).val($(el).val().toUpperCase());
}

var tableVenda = $('#tableVenda');
var tableApi = $('#tableApi');
var total = $('#total');
var qtd = 1;

$(function() {
    tableApi.on('click', 'tr', function() {
        var selectedRow = $(this);
        
        if (selectedRow.hasClass('selected')) {
            selectedRow.removeClass('selected');
        } else {
            $('#tableApi tbody tr.selected').removeClass('selected');
            selectedRow.addClass('selected');
        }
        
        var rowData = selectedRow.find('td').map(function() {
            return $(this).text();
        }).get();

        var data = [];
        rowData.forEach(function(linha) {
            data.push(linha)
        });
        data.push(qtd);

        $.post("/vender/vendaAndamento/registrar", {
            linha: data,
            _token: $('meta[name="csrf-token"]').attr('content')
        }, function(data) {
            updateTableVenda(data);
        });

        qtd = 1;
        $('#display-tableApi').css('display', 'none');
        $('#display-tableVenda').css('display', 'block');
        $('#search').val('');
    });
});

$(function() {
    
    
    $('#finalizarVenda').on('click', function() {
        var dados = [];
        var totalVenda = $('#total_venda').val();
        var totalItem = $('#total_item').val();
        var pagamento = $('#pagamento').val();
        var parcela = $('#parcela').val();
        var valorParcela = $('#valor_parcela').val();
        var desconto = $('#desconto').val();
        desconto = desconto.replace('%', '');
        var cliente = $('#cliente').val();

        dados.push(totalVenda, totalItem, pagamento, parcela, valorParcela, desconto, cliente);

        $.post("/vender/vendaAndamento/finalizar", {dados: dados , _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
            location.reload();
        });
    });


    $.post("/vender/vendaAndamento", { _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
        if(data){
            updateTableVenda(data);
        }
    });


    $('#search').on('keyup', function(e) {
        var search = $(this).val();

        if (search && search.indexOf('*') === -1) {
            $.post("/vender/estoque", { search, _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
                updateTable(data);
            });
            $('#display-tableApi').css('display', 'block');
            $('#display-tableVenda').css('display', 'none');
        } else if (search) {
            var searcSplit = search.split('*');
            qtd = searcSplit[0];
            var searchLetra = searcSplit[1];

            $.post("/vender/estoque", { search: searchLetra, _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
                updateTable(data);
            });
            $('#display-tableApi').css('display', 'block');
            $('#display-tableVenda').css('display', 'none');
        } else {
            $('#tableApi tbody').empty();
            $('#display-tableApi').css('display', 'none');
            $('#display-tableVenda').css('display', 'block');
        }
    });
});

function updateTable(data) {
    var tableBody = $('#tableApi tbody');
    tableBody.empty();
    
    data.forEach(function(item) {
        var newRow = $('<tr>');
        newRow.append('<td>' + item.id + '</td>');
        newRow.append('<td>' + item.nome + '</td>');
        newRow.append('<td>' + item.codigo_barras + '</td>');
        newRow.append('<td>' + item.preco + '</td>');
        newRow.append('<td>' + item.preco_custo + '</td>');
        newRow.append('<td>' + item.estoque + '</td>');
        tableBody.append(newRow);
    });
}
function updateTableVenda(data) {
    var headerRow = tableVenda.find('tr:first'); // Armazena o cabeçalho
    tableVenda.empty(); // Limpa apenas o corpo da tabela

    // Reanexa o cabeçalho após limpar o corpo da tabela
    tableVenda.append(headerRow);

    var contador = 1;
    var totalVendas = 0;
    var quantidadeTotal = 0;
    var tableBody = $('<tbody>'); // Criando um novo corpo da tabela

    data.forEach(function(item) {
        var newRow = $('<tr>');
        newRow.append('<td>' + contador + '</td>');
        newRow.append('<td>' + item.nome_produto + '</td>');
        newRow.append('<td>' + item.codigo_barras + '</td>');
        newRow.append('<td>' + item.quantidade + '</td>');
        newRow.append('<td>' + item.valor_item + '</td>');
        newRow.append('<td>' + item.total_venda + '</td>');

        totalVendas += parseFloat(item.total_venda);
        
        var actionColumn = $('<td>');
        var btnExcluir = $('<i>').addClass('fas fa-trash-alt btn bg-danger').attr('id', item.id).css('font-size', '10px');
        
        btnExcluir.on('click', function() {
            var idParaExcluir = $(this).attr('id');
            
            $.post("/vender/vendaAndamento/cancelar", {id: idParaExcluir, _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
                location.reload();
            });
        });
        
        actionColumn.append(btnExcluir);
        newRow.append(actionColumn);
        quantidadeTotal += item.quantidade;
        tableBody.append(newRow);
        $('#total_venda').val(totalVendas.toFixed(2));
        $('#valor_recebido').val(totalVendas.toFixed(2));

        $('#total_item').val(quantidadeTotal);
        total.text(totalVendas.toFixed(2));
        contador++;
    });

    tableVenda.append(tableBody); // Adiciona o novo corpo à tabela

    // Verifica se há mais de 10 linhas e define a altura máxima com uma barra de rolagem
    if (tableBody.children('tr').length > 10) {
        tableVenda.parent().css('max-height', '590px').css('overflow-y', 'auto');
    } else {
        tableVenda.parent().css('max-height', 'none').css('overflow-y', 'visible');
    }
}



$(function() {
    $('#tableApi').on('click', 'tr', function() {
        var row = $(this);

        if (row.hasClass('selected')) {
            row.removeClass('selected');
        } else {
            $('#tableApi tbody tr.selected').removeClass('selected');
            row.addClass('selected');
        }
    });
});

$(document).on('keydown', function(e) {
    if (!$('#modalFinalizarVenda').is(':visible')) {
        $('#search').focus();
    }
    $(document).on('input', '#total_venda, #valor_recebido', function() {
        var totalVenda = parseFloat($('#total_venda').val().replace(' ', '').replace(',', '.'));
        var totalRecebido = parseFloat($('#valor_recebido').val().replace(' ', '').replace(',', '.'));

        if (!isNaN(totalVenda) && !isNaN(totalRecebido)) {
            var troco = totalRecebido - totalVenda;
            $('#troco').val(troco.toFixed(2));
        } else {

            $('#troco').val('Valores inválidos');
        }
    });
});


