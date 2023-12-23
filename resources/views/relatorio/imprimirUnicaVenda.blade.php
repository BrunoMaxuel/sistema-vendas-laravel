<style>
    /* Estilos da tabela */
    #table-modal {
        border-collapse: collapse;
        width: 100%;
    }

    #table-modal th,
    #table-modal td {
        border: 1px solid #000; /* Define uma borda de 1px sólida preta para células e cabeçalhos */
        padding: 8px; /* Adiciona um espaço interno de 8px nas células */
        text-align: left; /* Alinhamento do texto à esquerda nas células */
    }

    #table-modal th {
        background-color: #f2f2f2; /* Define uma cor de fundo para os cabeçalhos */
    }
</style>

<div class="row">
    <h3>Histórico de todas as vendas</h3>
</div>
<div class="row">
	<table id="table-modal" cellspacing="0">
		<h3>Transações</h3>
        <thead>
            <tr>
                <th>N°</th>
                <th>Cliente</th>
                <th>Data e Hora</th>
                <th>Pag/Desconto</th>
                <th>Itens</th>
                <th>Parcela(R$)</th>
                <th>Total(R$)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transacoes as $transacao)
                <tr>
                    <td>{{$transacao->id}}</td>
                    <td>{{$transacao->cliente}}</td>
                    <td>{{$transacao->created_at}}</td>
                    <td>{{$transacao->pagamento}} / {{$transacao->desconto}}%</td>
                    <td>{{$transacao->total_item}}</td>
                    <td>{{$transacao->parcela}} x {{number_format($transacao->valor_parcela, 2, ',', '.')}}</td>
                    <td>{{number_format($transacao->total, 2, ',', '.')}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="row">
	<table id="table-modal" cellspacing="0">
		<h3>Vendas Realizadas</h3>
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
