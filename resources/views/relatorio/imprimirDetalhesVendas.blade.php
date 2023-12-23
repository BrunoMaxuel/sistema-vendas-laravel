<style>
    /* Estilos da tabela */
    #table-modal {
        border-collapse: collapse;
        width: 100%;
    }

    #table-modal th,
    #table-modal td {
        border: 1px solid #000; /* Define uma borda de 1px sólida preta para células e cabeçalhos */
        padding: 5px; /* Adiciona um espaço interno de 8px nas células */
        text-align: left; /* Alinhamento do texto à esquerda nas células */
    }

    #table-modal th {
        background-color: #f2f2f2; /* Define uma cor de fundo para os cabeçalhos */
    }
</style>
<div class="row">
	<table id="table-modal" cellspacing="0">
		<h3>Detalhes da venda</h3>
        <thead>
            <tr>
                <th>N°</th>
                <th>Produto</th>
                <th>Data de venda</th>
                <th>Quantia</th>
                <th>Preço</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendasDetalhada as $venda)
                <tr>
                    <td>{{$venda->id_transacao}}</td>
                    <td>{{$venda->nome_produto}}</td>
                    <td>{{$venda->created_at}}</td>
                    <td>{{$venda->quantidade}}</td>
                    <td>{{number_format($venda->valor_item, 2, ',', '.')}}</td>
                    <td>{{number_format($venda->total_venda, 2, ',', '.')}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>