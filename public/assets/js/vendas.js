//efeito de linha na tabela
$('#tableApi tbody').on('mouseover mouseout', 'tr', function(event) {
    if (event.type === 'mouseover') {
        $(this).css('background-color', '#aaa');
    } else {
        $(this).css('background-color', '');
    }
});
//Converter para maiusculo o input
function convertToUpper(el) {
    $(el).val($(el).val().toUpperCase());
}

var tableVenda = $('#tableVenda');
var tableApi = $('#tableApi');
var total = $('#total');
var qtd = 1;

$(function() {
    var item = 1;
    tableApi.on('click', 'tr', function() {
        var selectedRow = $(this); 

        if (selectedRow.hasClass('selected')) {
            selectedRow.removeClass('selected');
        } else {
            $('#tableApi tbody tr.selected').removeClass('selected'); 
            selectedRow.addClass('selected'); 
        }
        var rowData = selectedRow.find('td'); 
        var newRow = $('<tr>'); 

        for (var i = 0; i < rowData.length; i++) {
            var newCell = $('<td>'); 
            newCell.text($(rowData[i]).text());
            if(i == 0){
                newCell.text(item++);
            }
            if(i == 3){
                newCell.text(qtd);
            }
            if(i == 5){
                var result = qtd * parseFloat($(rowData[4]).text());

                if (!total.text().trim()) {

                    total.text(result.toFixed(2));

                } else {
                   
                    var currentTotal = parseFloat(total.text());
                    var newTotal = currentTotal + result;
                    total.text(newTotal.toFixed(2));
                }
            
                
            }
            newRow.append(newCell); 
        }
        qtd = 1;
        tableVenda.append(newRow); 
        $('#display-tableApi').css('display', 'none'); 
        $('#display-tableVenda').css('display', 'block'); 
        $('#search').val(''); 
    });
});


$(function() {
    $('#search').on('keyup', function(e) {
        var search = $('#search').val();
        
        var searcSplit = search.split('*');
        var searchLetra = searcSplit[1];
        var searchTraco = search.split('-');
        var itemRemove = searchTraco[1];
        
        if (search && searcSplit.length == 1) {
            // Se houver apenas um termo digitado (sem asterisco), faz a pesquisa normal
            
            $.post("/vender/estoque", { search, _token: $('meta[name="csrf-token"]').attr('content') }, function (data) {
                $('#tableApi tbody').empty();
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
        } else if (searchLetra && searchLetra.length > 0) {
            // Se houver um termo após o asterisco, faz a pesquisa com base nesse termo
            qtd = searcSplit[0];
            
            $.post("/vender/estoque", { search: searchLetra, _token: $('meta[name="csrf-token"]').attr('content') }, function (data) {
                $('#tableApi tbody').empty();
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
            
        }
        else {
            $('#tableApi tbody').empty();
            $('#display-tableApi').css('display', 'none');
            $('#display-tableVenda').css('display', 'block');
        }

        if (itemRemove == 1 && e.keyCode == 13) {
            var itemToRemove = 1;
        
            $('#tableVenda tbody tr').each(function() {
                var numeroItemAtual = parseInt($(this).find('td:eq(0)').text());
        
                if (numeroItemAtual === itemToRemove) {
                    $(this).remove();
                    return false; // Termina o loop após remover a linha
                }
            });
        
            if (!linhaRemovida) {
                console.log('Item não encontrado para remoção');
            }
        }
        

        // if (/^\d+\*[a-zA-Z]*$/.test(search)) {
        //     // Faz uma requisição post para a rota e ela retorna um array de objeto

        //     var searchLetra = search.split('*')[1];
        //     $.post("/vender/estoque", { searchLetra, _token: $('meta[name="csrf-token"]').attr('content') }, function (data) {
        //         // Limpa antes de inserir novos registros
        //         $('#tableApi tbody').empty();
        //         // Busca os dados do banco para a tabela Api
        //         data.forEach(function(data) {
        //             var newRow = $('<tr>');
        //             newRow.append('<td>' + data.id + '</td>');
        //             newRow.append('<td>' + data.nome + '</td>');
        //             newRow.append('<td>' + data.codigo_barras + '</td>');
        //             newRow.append('<td>' + data.preco + '</td>');
        //             newRow.append('<td>' + data.preco_custo + '</td>');
        //             newRow.append('<td>' + data.estoque + '</td>');
        //             tableApi.append(newRow);
        //         });
        //     });
        //     $('#display-tableApi').css('display', 'block');
        //     $('#display-tableVenda').css('display', 'none');
        // } else {
        //     // $('#tableApi tbody').empty();
        //     // $('#display-tableApi').css('display', 'none');
        //     // $('#display-tableVenda').css('display', 'block');
        // }
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
    $('#search').focus();

    var rowCount = tableApi.find('tr').length;
    var code = e.which || e.keyCode;
    var preventKeys = [112, 113, 114, 115, 117, 118, 119, 120, 121, 123];
    if ($.inArray(code, preventKeys) !== -1 || (rowCount > 1 && code === 116)) {
        e.preventDefault();
        if (rowCount > 1 && code === 116) {
            $('#confirmation-dialog').css('display', 'block');
        }
    }
});

$('#btnCancel').click(function() {
    $('#confirmation-dialog').css('display', 'none');
});
$('#btnConfirmUpdate').click(function() {
    location.reload();
});

    //enviar dados para salvar
//     $(function() {
//     $('#finalizarVenda').on('click', function() { 
//         var tableData = [];
//         $('#tableVenda tbody tr').each(function() {
//             var rowData = {};
//             $(this).find('td').each(function(index) {
//                 rowData[index] = $(this).text();
//             });
//             tableData.push(rowData);
//         });

//         // Envia os dados para uma rota utilizando AJAX
//         $.ajax({
//             url: {{route('venda.registrar')}}, 
//             method: 'POST', 
//             data: { tableData: tableData }, // Envia os dados como um objeto
//             success: function(response) {
//                 // Sucesso - faça algo com a resposta do backend, se necessário
//             },
//             error: function(error) {
//                 // Tratamento de erro, se houver
//             }
//         });
//     });
// });

