
function convertToUpper(el) {
    $(el).val($(el).val().toUpperCase());
}
$('#search').on('keydown', function(e) {
    if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
        e.preventDefault();
    }
});
var searchPartes = [1];
var linhaSelecionada = 0;
var displayTableApi = $('#display-tableApi');
var displayTableVenda = $('#display-tableVenda');
var infoVenda = $('.info-venda');
var tableApiBody = $('.table-api tbody');
var tabelaVenda = $('.table-venda tbody');
$(function() {
    atualizarTabelaVenda();        
    $('#search').on('keyup', function(e) {
        if (e.key == 'ArrowUp' || e.key == 'ArrowDown') {
            if (e.key === 'ArrowUp' && linhaSelecionada > 0) {

                tableApiBody.find('tr').removeClass('selected').css('background-color', '');
                tableApiBody.find('tr').eq(--linhaSelecionada).addClass('selected').css('background-color', '#aaa');
            } else if (e.key === 'ArrowDown' && linhaSelecionada < tableApiBody.find('tr').length - 1) {

                tableApiBody.find('tr').removeClass('selected').css('background-color', '');
                tableApiBody.find('tr').eq(++linhaSelecionada).addClass('selected').css('background-color', '#aaa');
            }
        } else {
            linhaSelecionada = 0;
            var search = $(this).val();
    
            if (search && search.indexOf('*') === -1) {
                $.post("/vender/estoque", { search, _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
                    preencherTabelaBusca(data);
                    tableApiBody.find('tr').eq(linhaSelecionada).addClass('selected').css('background-color', '#aaa');
                    displayTableApi.removeClass('hidden');
                    infoVenda.addClass('hidden');
                });
            }
            else if(search && search.indexOf('*') > -1){
                searchPartes = search.split('*');
                
               if(searchPartes[1]){
                    $.post("/vender/estoque", { search: searchPartes[1], _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
                        preencherTabelaBusca(data);
                        tableApiBody.find('tr').eq(linhaSelecionada).addClass('selected').css('background-color', '#aaa');
                        displayTableApi.removeClass('hidden');
                        infoVenda.addClass('hidden');
                    });
               }
            }
             else {
                displayTableApi.addClass('hidden');
                infoVenda.removeClass('hidden');
                atualizarTabelaVenda();
            }
        }

    });
    $('#search').on('keypress', function(e) {
        if (e.key === 'Enter' && !displayTableApi.hasClass("hidden")) {
            displayTableApi.addClass('hidden');
            infoVenda.removeClass('hidden');
            $('#search').val('');   
            var linhaSelecionada = tableApiBody.find('tr.selected');
            var nome = linhaSelecionada.find('td:eq(1)').text();
            var codigo_barras = linhaSelecionada.find('td:eq(2)').text();
            var preco = linhaSelecionada.find('td:eq(4)').text();

            var listaVenda = JSON.parse(localStorage.getItem('listaVenda')) || [];

            var precoFloat = parseFloat(preco.replace(',', '.'));
            var quantidade = parseFloat(searchPartes[0]);
            var valorTotal = precoFloat * quantidade;
            valorTotal = valorTotal.toFixed(2).replace('.', ',');

            listaVenda.push({
                nome: nome,
                codigo_barras: codigo_barras,
                quantidade: searchPartes[0],
                preco: preco,
                total: valorTotal
            });
            localStorage.setItem('listaVenda', JSON.stringify(listaVenda));          
            atualizarTabelaVenda();
        }
    });
       
});
function atualizarTabelaVenda() {
    tabelaVenda.empty();
    qtdItem = 0;
    totalVenda= 0;
    var listaVenda = JSON.parse(localStorage.getItem('listaVenda')) || [];
    
    if (listaVenda.length > 0) {
        listaVenda.forEach(function (item, index) {
            var newRow = $('<tr>');
            newRow.append('<td>' + (index + 1) + '</td>');
            newRow.append('<td>' + item.nome + '</td>');
            newRow.append('<td>' + item.codigo_barras + '</td>');
            newRow.append('<td>' + item.quantidade + '</td>');
            newRow.append('<td>' + item.preco + '</td>');
            newRow.append('<td>' + item.total + '</td>');
            tabelaVenda.append(newRow);
            qtdItem += item.quantidade;
            totalVenda += parseFloat(item.total);
            console.log(totalVenda);
        });
    } 
    $('#total').text(totalVenda.toFixed(2).replace('.', ','));
    var table = $('.table-venda');
    table.parent().css('max-height', '400px').css('overflow-y', 'auto');
    verificarLinhasTabelaVenda(); 
}
function preencherTabelaBusca(data) {
    tableApiBody.empty();    
    data.forEach(function(item) {
        var newRow = $('<tr>');
        newRow.append('<td>' + item.id + '</td>');
        newRow.append('<td>' + item.nome + '</td>');
        newRow.append('<td>' + item.codigo_barras + '</td>');
        newRow.append('<td>' + item.preco_custo + '</td>');
        newRow.append('<td>' + item.preco + '</td>');
        newRow.append('<td>' + item.estoque + '</td>');
        tableApiBody.append(newRow);
    });
}

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
        var linhas = $('.table-venda tbody tr').length;
        e.preventDefault();
        if(linhas !== 0){
            $('#btnFinalizar').click();
        }
    }
    if(e.which == 114 && $('#btnFinalizar button').prop('disabled') == false){
        e.preventDefault();
        $('#btnCancelar').click();
    }
});

$(document).ready(function() {
    $('#vendaForm input').keydown(function(event) {
        if (event.which == 13) { 
                event.preventDefault(); 
                $('#btnModalFinalizar').click(); 
        }
        if (event.which == 27) {
            $('#modalTransacao').modal('hide');
        }
       
    });

    $('#btnFinalizar').on('click', function() {
        $('#modalTransacao').modal('show');

        setTimeout(function() {
            $('#valor_recebido').focus();
        }, 1000);
    });

    $('#btnModalFinalizar').on('click', function() {
        const rota = "/vender/finalizar";
        $('#formTransacao').attr('action', rota);
    });
    
    setTimeout(verificarLinhasTabelaVenda,400);
});
$('#btnModalCancel').on('click', function () {
    $('#modalTransacao').modal('hide');     
});

function verificarLinhasTabelaVenda() {
    var linhas = $('.table-venda tbody tr').length;
    if (linhas === 0) {
        $('#btnFinalizar button').prop('disabled', true);
        $('#btnCancelar button').prop('disabled', true);
    } else {
        $('#btnFinalizar button').prop('disabled', false);
        $('#btnCancelar button').prop('disabled', false);
    }
}

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

