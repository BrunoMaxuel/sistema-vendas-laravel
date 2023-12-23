@extends('adminlte::page')

@section('title', 'Histórico de vendas')
@section('css')
	<style>
		.cor-linha{
			background-color: #0A8DC6;
			color:white;
			padding: 30px;
			border-radius: 5px;
		}

	</style>
@stop

@section('content')
	<x-modalMsg.modalHistorico/>
	<div class="row cor-linha">
		<div class="col-md-5">
			<h2>Histórico de Vendas</h2>
		</div>
		<div class="col-md-7 d-flex justify-content-end">
			<button onclick="imprimirConteudo()"  type="submit" class="btn btn-light p-2">Imprimir Todas Vendas<span class="glyphicon glyphicon-print"></span></button>
		</div>
	</div>
	
		<table id="transations-table" class="table hover order-column compact table-bordered" cellspacing="0" width="100%">
			<thead class="thead-light">
			<tr>
				<th scope="col">N°</th>
				<th scope="col">Cliente</th>
				<th scope="col">Data</th>
				<th scope="col">Pag/desconto</th>
				<th scope="col">Itens</th>
				<th scope="col">Parcela(R$)</th>
				<th scope="col">Total(R$)</th>
				<th scope="col">Ação</th>
			</tr>
			</thead>
			<tbody>
				@foreach ($transactions as $transacao)
				<tr>
					<td>{{$transacao->id}}</td>
					<td>{{$transacao->cliente}}</td>
					<td>{{$transacao->created_at->toDateString()}}</td>
					<td>{{$transacao->pagamento}} / {{$transacao->desconto}}%</td>
					<td>{{$transacao->total_item}}</td>
					<td>{{$transacao->parcela}} x {{number_format($transacao->valor_parcela, 2, ',', '.')}}</td>
					<td>{{number_format($transacao->total, 2, ',', '.')}}</td>
					<td>
						<i style="cursor: pointer; background-color:#ddd; border-radius:4px; padding: 10px;" data-id="{{$transacao->id}}" class="fas fa-eye text-blue visualizar"></i>

						<i class="m-2"></i>
						
						<i style="cursor: pointer; background-color:#ddd; border-radius:4px; padding: 10px;" class="fas fa-edit text-success editar"></i>
						<i class="m-2"></i>
						<i style="cursor: pointer; background-color:#ddd; border-radius:4px; padding: 10px;" class="fas fa-trash-alt text-danger excluir"></i>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
@stop
@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script type="text/javascript">
    $(function() {
			$('.visualizar').click(function() {
			var id = $(this).data('id');
			var token = "{{ csrf_token() }}";

			$.post('/historico', { dataId: id, _token: token })
			.done(function(vendaDetalhes) {
				$('#table-modal tbody').empty();
				
				$.each(vendaDetalhes, function(index, venda) {

					var valorItemFormatted = parseFloat(venda.valor_item).toLocaleString('pt-br', {minimumFractionDigits: 2});
					var totalVendaFormatted = parseFloat(venda.total_venda).toLocaleString('pt-br', {minimumFractionDigits: 2});

					console.log(venda.cliente);
					var newRow = '<tr>' +
						'<td>' + venda.id + '</td>' +
						'<td>' + venda.nome_produto + '</td>' +
						'<td>' + venda.quantidade + '</td>' +
						'<td>' + valorItemFormatted + '</td>' +
						'<td>' + totalVendaFormatted + '</td>' +
						'</tr>';
					$('#table-modal tbody').append(newRow);
				});
				$('#modalHistorico').modal('show');
			})
			.fail(function(error) {
				console.error(error);
			});
		});
        $('.editar').click(function() {
            console.log('Editando...');
        });
        $('.excluir').click(function() {
            console.log('Excluindo');
        });
    });
	function closePrint () {
    		  document.body.removeChild(this.__container__);
    	}
	function setPrint () {
   		  this.contentWindow.print();
   	}

	function imprimirConteudo() {
		var newFrame = document.createElement("iframe");
   		  newFrame.onload = setPrint;
   		  newFrame.style.visibility = "hidden";
   		  newFrame.style.position = "fixed";
   		  newFrame.style.right = "0";
   		  newFrame.style.bottom = "0";
   		  newFrame.src = "historico/imprimirVendas";
   		  document.body.appendChild(newFrame);
}
</script>
@stop