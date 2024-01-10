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
        rowData.forEach(function(linha, index) {
            if(index === 3){
                var valorNumerico = parseFloat(linha.replace(/\./g, '').replace(',', '.'));
                data.push(valorNumerico);
            }else{
                data.push(linha);
            }
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
        } else if (search.length === 13) {
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

    if (tableBody.children('tr').length > 6) {
        tableApi.parent().css('max-height', '400px').css('overflow-y', 'auto');
    } else {
        tableApi.parent().css('max-height', 'none').css('overflow-y', 'visible');
    }
}
function updateTableVenda(data) {
    var headerRow = tableVenda.find('tr:first');
    tableVenda.empty();
    tableVenda.append(headerRow);

    var contador = 1;
    var valorVendaTotal = quantidadeTotal = 0;
    var tableBody = $('<tbody>');

    data.forEach(function(item) {
        
        var newRow = $('<tr>');
        newRow.append('<td>' + item.nome_produto + '</td>');
        newRow.append('<td>' + item.codigo_barras + '</td>');
        newRow.append('<td>' + item.quantidade + '</td>');
        newRow.append('<td>' + item.valor_item + '</td>');
        newRow.append('<td>' + item.total_venda + '</td>');
        valorVendaTotal += parseFloat(item.total_venda.replace(/\./g, '').replace(',', '.'));

        var actionColumn = $('<td>');
        var btnExcluir = $('<i>').addClass('fas fa-trash-alt btn bg-danger').attr('id', item.id_venda).css('font-size', '10px');
        
        btnExcluir.on('click', function() {
            var idParaExcluir = $(this).attr('id');
            console.log(idParaExcluir);
            
            $.post("/vender/vendaAndamento/cancelar", {id_venda : idParaExcluir, _token: $('meta[name="csrf-token"]').attr('content') }, function() {
                location.reload();
            });
        });
        
        actionColumn.append(btnExcluir);
        newRow.append(actionColumn);
        tableBody.append(newRow);
        contador++;
        //preencher modal
        quantidadeTotal += item.quantidade;
        $('#total_item').val(quantidadeTotal);
        $('#valor_recebido').val(valorVendaTotal.toLocaleString('pt-br', { maximumFractionDigits: 2 }));
        $('#total_venda').val(valorVendaTotal.toLocaleString('pt-br', { maximumFractionDigits: 2 }));
        var totalVenda = parseFloat($('#total_venda').val().replace('.', '').replace(',', '.'));
        $('#venda_desconto').val(totalVenda.toLocaleString('pt-br', {maximumFractionDigits: 2}));
        var parcela = parseInt($('#parcela').val());
        if(parcela > 1){
            valorParcela = totalVenda / parcela;
        }
        else{
            $('#valor_parcela').val(totalVenda.toLocaleString('pt-br', { maximumFractionDigits: 2 }));
        }
        total.text(valorVendaTotal.toLocaleString('pt-br', { maximumFractionDigits: 2 }));
        
    });$('#btnFinalizar button').prop('disabled', false);
    $('#btnCancelar button').prop('disabled', false);

    tableVenda.append(tableBody);

    if (tableBody.children('tr').length > 6) {
        tableVenda.parent().css('max-height', '370px').css('overflow-y', 'auto');
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
    if (!$('#modalTransacao').is(':visible')) {
        $('#search').focus();
    }
    $(document).on('input', '#valor_recebido, #desconto', function() {
        var totalVenda    = parseFloat($('#total_venda').val().replace('.', '').replace(',', '.'));
        var desconto      = parseInt($('#desconto').val().replace('%', ''));
        var totalRecebido = parseFloat($('#valor_recebido').val().replace('.', '').replace(',', '.'));        
        
        if (isNaN(desconto)) {
            desconto = 0; 
        }
    
        if (!isNaN(totalVenda) && !isNaN(totalRecebido)) {
            var parcela          = parseInt($('#parcela').val().replace('x', ''));
            var totalComDesconto = totalVenda - (totalVenda * (desconto / 100));
            var valor_parcela    = totalComDesconto / parcela;
            var troco            = totalRecebido - totalComDesconto;
    
            $('#venda_desconto').val(totalComDesconto.toLocaleString('pt-br', {maximumFractionDigits: 2}));
            $('#valor_parcela').val(valor_parcela.toLocaleString('pt-br', {maximumFractionDigits: 2}));
            $('#troco').text(troco.toLocaleString('pt-br', {maximumFractionDigits: 2}));
        } else {
            $('#troco').text('0,00');
        }
    });
    if (e.which === 118) { 
        var linhas = $('#tableVenda tbody tr').length;
        e.preventDefault();
        if(linhas !== 0){
            $('#btnFinalizar').click();
        }
    }
});

$(document).ready(function() {
    $('#vendaForm input').keydown(function(event) {
        if (event.which == 13) { 
                event.preventDefault(); 
                $('#finalizarVenda').click(); 
        }
    });


    $('#btnFinalizar').on('click', function() {
        $('#modalTransacao').modal('show');
        setTimeout(function() {
            $('#valor_recebido').focus();
        }, 1000);
    });
    
    // $('#btnCancelar').on('click', function() {
    //     $('#modalAlert').modal('show');
    //     $('.modal-title').text('Cancelamento de venda');
    //     $('#title-body').text('Deseja cancelar a venda?');
    //     $('.btn-cancelar').text('Cancelar');
    //     $('#btnSubmit').text('Excluir todos itens');
    // });

    $('#btnSubmit').on('click', function() {
        console.log("asdas");
        const rota = "/vender/finalizar";
        $('#formTransacao').attr('action', rota);
    });
    
    function verificarLinhasTabelaVenda() {
        var linhas = $('#tableVenda tbody tr').length;
        if (linhas === 0) {
            $('#btnFinalizar button').prop('disabled', true);
            $('#btnCancelar button').prop('disabled', true);
        } else {
            $('#btnFinalizar button').prop('disabled', false);
            $('#btnCancelar button').prop('disabled', false);
        }
    }
    setTimeout(verificarLinhasTabelaVenda,400);
  });


$(document).on('change', '#parcela', function() {
    var vendaDescont = parseFloat($('#venda_desconto').val().replace('.', '').replace(',', '.'));
    var parcela = parseInt($('#parcela').val().replace('x', ''));
    var valorParcela = vendaDescont / parcela;
    


    if (!isNaN(vendaDescont) && !isNaN(parcela) && parcela !== 0) {
        var valorParcela = vendaDescont / parcela;
        $('#valor_parcela').val(valorParcela.toLocaleString('pt-br', {maximumFractionDigits: 2}));
    } else {
        $('#valor_parcela').val('0,00');
    }
});