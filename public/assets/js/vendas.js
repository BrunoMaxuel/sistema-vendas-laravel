function convertToUpper(el) {
    $(el).val($(el).val().toUpperCase());
}

//ação de mover sobre linhas
$('#search').on('keydown', function(e) {
    if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
        e.preventDefault();
        if (e.key === 'ArrowUp' && linhaSelecionada > 0) {

            tableApiBody.find('tr').removeClass('selected').css('background-color', '');
            tableApiBody.find('tr').eq(--linhaSelecionada).addClass('selected').css('background-color', '#aaa');
        } else if (e.key === 'ArrowDown' && linhaSelecionada < tableApiBody.find('tr').length - 1) {

            tableApiBody.find('tr').removeClass('selected').css('background-color', '');
            tableApiBody.find('tr').eq(++linhaSelecionada).addClass('selected').css('background-color', '#aaa');
        }
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
    //assim que o script é recarregado a função é chamada
    atualizarTabelaVenda();        
    //Input para pesquisar
    $('#search').on('keyup', function(e) {
        if (e.key !== 'ArrowUp' && e.key !== 'ArrowDown') {
            linhaSelecionada = 0;
            var search = $(this).val();
    
            if (search) {
                if (search.indexOf('*') == -1 && search.indexOf('-') == -1) {
                    $.post("/vendas/produtos", { search, _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
                        preencherTabelaBusca(data);
                        tableApiBody.find('tr').eq(linhaSelecionada).addClass('selected').css('background-color', '#aaa');
                        displayTableApi.removeClass('hidden');
                        infoVenda.addClass('hidden');
                    });
                }
                else if(search.indexOf('*') > -1 && search.indexOf('-') == -1 ){
                    searchPartes = search.split('*');
                    
                   if(searchPartes[1]){
                        $.post("/vendas/produtos", { search: searchPartes[1], _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
                            preencherTabelaBusca(data);
                            tableApiBody.find('tr').eq(linhaSelecionada).addClass('selected').css('background-color', '#aaa');
                            displayTableApi.removeClass('hidden');
                            infoVenda.addClass('hidden');
                        });
                   }
                }
                else if(search.length < 5 && search.indexOf('-') > -1 && e.key === 'Enter'){
                    var indice = search.split('-');
                    var indice = indice[1];
                    var listaVenda = JSON.parse(localStorage.getItem('listaVenda')) || [];
                    if (indice > 0 && indice <= listaVenda.length) { // Verifica se o índice é válido
                        listaVenda.splice(--indice, 1); // Remove 1 elemento na posição 'indice'
                        localStorage.setItem('listaVenda', JSON.stringify(listaVenda)); // Atualiza o localStorage
                        console.log("Item removido com sucesso.");
                        atualizarTabelaVenda();
                        $('#search').val("");
                    } else {
                        console.log("Índice inválido. Não foi possível remover o item.");
                    }
                }
                else {
                    displayTableApi.addClass('hidden');
                    infoVenda.removeClass('hidden');
                    atualizarTabelaVenda();
                }
            }
            else {
                displayTableApi.addClass('hidden');
                infoVenda.removeClass('hidden');
                atualizarTabelaVenda();
            }
        }
    });
    //Passa o conteudo da tabela do banco de dados para o localStorage
    $('#search').on('keypress', function(e) {
        if (e.key === 'Enter' && !displayTableApi.hasClass("hidden")) {
            displayTableApi.addClass('hidden');
            infoVenda.removeClass('hidden');
            $('#search').val('');   
            var linhaSelecionada = tableApiBody.find('tr.selected');

            var id = linhaSelecionada.find('td:eq(0)').text();
            var nome = linhaSelecionada.find('td:eq(1)').text();
            var codigo_barras = linhaSelecionada.find('td:eq(2)').text();
            var preco = linhaSelecionada.find('td:eq(4)').text();

            var listaVenda = JSON.parse(localStorage.getItem('listaVenda')) || [];

            var precoFloat = parseFloat(preco.replace(',', '.'));
            var quantidade = parseFloat(searchPartes[0]);
            var valorTotal = precoFloat * quantidade;
            valorTotal = valorTotal.toFixed(2).replace('.', ',');

            listaVenda.push({
                id: id,
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
//Passa conteudo do localStorage para tabela venda e se tiver mais de 1 item, libera os botoes finalizar e cancelar vendas
function atualizarTabelaVenda() {
    tabelaVenda.empty();
    qtdItem = 0;
    totalVenda= 0.00;
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
            qtdItem += parseInt(item.quantidade);
            totalVenda += parseFloat(item.total.replace(',', '.'));
        });
    } 
    $('.total_valor_venda').text(totalVenda.toFixed(2).replace('.', ','));
    $('.total_item_venda').text(qtdItem);
    var table = $('.table-venda');
    table.parent().css('max-height', '400px').css('overflow-y', 'auto');
    verificarLinhasTabelaVenda(); 
}
//tabela do banco de dados
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
//evento keydown
$(document).on('keydown', function(e) {
    //se o modal não estiver visível, qualquer tecla pressionada deixa o campo de busca ativo
    if (!$('#modalTransacao').is(':visible')) {
        $('#search').focus();
    }
    //evento de mudanças do input do modal finalizar vendas
    $(document).on('input', '#valor_recebido, #desconto, #parcela', function() {
        var totalVenda    = parseFloat($('.total_valor_venda').text().replace('.', '').replace(',', '.'));
        var desconto      = parseInt($('#desconto').val().replace('%', ''));
        var totalRecebido = parseFloat($('#valor_recebido').val().replace('.', '').replace(',', '.'));
        if (isNaN(desconto)) {
            desconto = 0; 
        }
        //calculos de finalizar vendas
        if (!isNaN(totalVenda) && !isNaN(totalRecebido)) {
            var parcela          = parseInt($('#parcela').val().replace('x', ''));
            var totalComDesconto = totalVenda - (totalVenda * (desconto / 100));
            var valor_parcela    = totalComDesconto / parcela;
            var troco            = totalRecebido - totalComDesconto;
            $('#venda_desconto_modal').val(totalComDesconto.toLocaleString('pt-br', {maximumFractionDigits: 2}));
            $('#valor_parcela').val(valor_parcela.toLocaleString('pt-br', {maximumFractionDigits: 2}));
            $('#troco').text(troco.toLocaleString('pt-br', {maximumFractionDigits: 2}));
        } else {
            $('#troco').text('0,00');
        }
    });
    //o modal finalizar venda é aberto caso pressione a tecla F7 e tenha itens de venda
    if (e.which === 118) { 
        var linhas = $('.table-venda tbody tr').length;
        e.preventDefault();
        if(linhas !== 0){
            $('#btnFinalizar').click();
        }
    }
    //A tecla F3 abre um modal perguntando se deseja cancelar toda a venda
    if(e.which == 114 && $('#btnFinalizar button').prop('disabled') == false){
        e.preventDefault();
        $('#btnCancelar').click();
    }
});
//evento no input de keydown
$('#vendaForm input').keydown(function(event) {
    //tecla enter finaliza a venda completamente!
    if (event.which == 13) { 
            event.preventDefault(); 
            $('#btnModalFinalizar').click(); 
    }
    //tecla ESC fecha o modal
    if (event.which == 27) {
        $('#modalTransacao').modal('hide');
    }
   
});
//abre o modal com informações nele
$('#btnFinalizar').on('click', function() {
    $('#modalTransacao').modal('show');
    $('#total_venda_modal').val($('.total_valor_venda').text());
    $('#total_item_modal').val($('.total_item_venda').text());
    $('#venda_desconto_modal').val($('.total_valor_venda').text());
    $('#valor_recebido').val($('.total_valor_venda').text());
    $('#valor_parcela').val($('.total_valor_venda').text());
    $('#venda_detalhada').val(localStorage.getItem('listaVenda'));
    console.log($('#venda_detalhada').val());
    setTimeout(function() {
        $('#valor_recebido').focus();
    }, 500);
});

//finaliza venda completamente
$('#btnModalFinalizar').on('click', function() {
    const rota = "/vender";
    $('#formTransacao').attr('action', rota);
});

//fecha o modal de finalizar venda
$('#btnModalCancel').on('click', function () {
    $('#modalTransacao').modal('hide');     
});
//verifica linhas da tabela para desabilitar botões de finalizar e cancelar vendas
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


