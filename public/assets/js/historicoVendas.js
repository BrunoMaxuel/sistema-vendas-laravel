$(document).on('change', '#parcela', function() {
    var totalVenda = parseFloat($('#total_venda').text().replace('.', '').replace(',', '.'));
    var parcela = parseInt($(this).val());
    var valorParcela = totalVenda / parcela;
    $('#valor_parcela').val(valorParcela.toLocaleString('pt-br', {minimumFractionDigits: 2}));


    if (!isNaN(totalVenda) && !isNaN(parcela) && parcela !== 0) {
        var valorParcela = totalVenda / parcela;
        $('#valor_parcela').val(valorParcela.toFixed(2).replace('.', ','));
    } else {
        $('#valor_parcela').val('0,00');
    }
});


$(document).on('keydown', function(e) {
    if (!$('#modalFinalizarVenda').is(':visible')) {
        $('#search').focus();
    }
    $(document).on('input', '#total_venda, #valor_recebido, #desconto', function() {
        var totalVenda = parseFloat($('#total_venda').text().replace('.', '').replace(',', '.'));
        var desconto = parseInt($('#desconto').val());

        var totalRecebido = parseFloat($('#valor_recebido').val().replace('.', '').replace(',', '.'));        
        
        if (isNaN(desconto)) {
            desconto = 0; 
        }
    
        if (!isNaN(totalVenda) && !isNaN(totalRecebido)) {
            var totalComDesconto = totalVenda - (totalVenda * (desconto / 100));
            $('#venda_desconto').text(totalComDesconto.toLocaleString('pt-br', {minimumFractionDigits: 2}));
            var troco = totalRecebido - totalComDesconto;
    
            $('#troco').text(troco.toLocaleString('pt-br', {minimumFractionDigits: 2}));
        } else {
            $('#troco').text('0,00');
        }
    });
});

$('.modal-title').text('Edição de venda');
$('#finalizarVenda').text('Salvar Alterações');

$('#finalizarVenda').on('click', function() {
    var dados = [];
    var vendaComDesconto = $('#venda_desconto').text();
    var pagamento = $('#pagamento').val();
    var parcela = $('#parcela').val();
    var valorParcela = $('#valor_parcela').val();
    var desconto = $('#desconto').val();

    var id = $('#id_transacao').val();
    if(desconto == null){
        desconto = 1;
    }
    desconto = parseInt(desconto.replace('%', ''));
    parcela = parseInt(parcela.replace('x', ''));

    var cliente = $('#cliente').val();

    dados.push(pagamento, parcela, valorParcela, desconto, cliente, vendaComDesconto, id);

    $.post("/historico/editar", {dados: dados , _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
        location.reload();
        // console.log('Passou'); 
    });
});

$(document).ready(function() {
    $('#vendaForm input').keydown(function(event) {
        if (event.which == 13) { 
                event.preventDefault(); 
                $('#finalizarVenda').click(); 
        }
    });
  });