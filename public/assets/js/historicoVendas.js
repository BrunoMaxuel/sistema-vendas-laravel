$(document).on('change', '#parcela', function() {
    var vendaDescont = parseFloat($('#venda_desconto').val().replace('.', '').replace(',', '.'));
    var parcela = parseInt($('#parcela').val().replace('x', ''));
    var valorParcela = vendaDescont / parcela;
    


    if (!isNaN(vendaDescont) && !isNaN(parcela) && parcela !== 0) {
        var valorParcela = vendaDescont / parcela;
        $('#valor_parcela').val(valorParcela.toLocaleString('pt-br', {minimumFractionDigits: 2}));
    } else {
        $('#valor_parcela').val('0,00');
    }
});

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

        $('#venda_desconto').val(totalComDesconto.toLocaleString('pt-br', {minimumFractionDigits: 2}));
        $('#valor_parcela').val(valor_parcela.toLocaleString('pt-br', {minimumFractionDigits: 2}));
        
        $('#troco').text(troco.toLocaleString('pt-br', {minimumFractionDigits: 2}));
    } else {
        $('#troco').text('0,00');
    }
});
