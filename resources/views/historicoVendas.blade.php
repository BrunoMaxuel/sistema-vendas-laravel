@extends('adminlte::page')

@section('title', 'Histórico de vendas')
@push('css')
	<style>
		.cor-linha{
			background-color: #343A40;
			color:white;
			padding: 15px;
			border-radius: 5px;
		}

	</style>
@endpush
@section('content_header')
	<div class="row cor-linha">
		<div class="col-md-4">

		</div>
		<div class="col-md-4">
			<h3>Histórico de Vendas</h3>
		</div>
		<div class="col-md-4 d-flex justify-content-end">
			<x-form.button onclick="imprimirConteudo('historico/imprimirVendas')" type="button" theme="light"  label="Imprimir Histórico" />
		</div>
	</div>
@stop
@section('content')
	<x-modals.modalHistorico/>
	<x-modals.modalVenda/>
	<x-modals.modalExcluir/>
	<x-modals.modalMsg/>
	<div class="table-responsive">
		<table id="transations-table" class="custom-table table hover order-column compact table-bordered" >
			<thead class="thead-light">
			<tr>
				<th scope="col">N°</th>
				<th scope="col">Cliente</th>
				<th scope="col">Data</th>
				<th scope="col">Desc</th>
				<th scope="col">Itens</th>
				<th scope="col">Com Desc(R$)</th>
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
					<td style="display: none;">{{$transacao->pagamento}}</td>
					<td>{{$transacao->desconto}}%</td>
					<td>{{$transacao->total_item}}</td>
					<td style="display: none;">{{$transacao->parcela}}x</td>
					<td style="display: none;">{{number_format($transacao->valor_parcela, 2, ',', '.')}}</td>
					<td>{{number_format($transacao->venda_com_desconto, 2, ',', '.')}}</td>
					<td>{{number_format($transacao->total, 2, ',', '.')}}</td>
					<td>
						<x-form.button class="visualizar " data-id="{{$transacao->id}}" type="button" theme="primary" icon="fas fa-eye" label="" />
						<x-form.button class="editar " data-id="{{$transacao->id}}" type="button" theme="success" icon="fas fa-edit" label="" />
						<x-form.button class="excluir " data-id="{{$transacao->id}}" type="button" theme="danger" icon="fas fa-trash-alt" label="" />
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@if(session('msg'))
    <div id="mensagem" >
    </div>
@endif
@stop
@push('js')
	<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
	<script type="text/javascript">
		$('#btnModalFinalizar').on('click', function() {
			const rota = "/historico/editar";
			$('#formTransacao').attr('action', rota);
		});


		$(function() {

			var mensagem = document.getElementById('mensagem');
			if (mensagem) {
				showModal();
				function showModal(){
					$("#background-text").addClass("bg-success");
					$("#titulo-msg").html("Informações alteradas com sucesso!");
					setTimeout(function() {
							$('#modal-msg').modal('show');
					}, 500);
					setTimeout(function() {
							$('#modal-msg').modal('hide');
					}, 2000);
				}
			}

			$('.editar').click(function() {
				$('#modalTransacao').modal('show');
				const linha 	= $(this).closest('tr');
				$('#idTransacao').val(linha.find('td:nth-child(1)').text());
				$('#cliente').val(linha.find('td:nth-child(2)').text());
				$('#pagamento').val(linha.find('td:nth-child(4)').text());
				$('#desconto').val(linha.find('td:nth-child(5)').text());
				$('#total_item_modal').val(linha.find('td:nth-child(6)').text());
				$('#parcela').val(linha.find('td:nth-child(7)').text());
				$('#valor_parcela').val(linha.find('td:nth-child(8)').text());
				$('#venda_desconto_modal').val(linha.find('td:nth-child(9)').text());
				$('#total_venda_modal').val(linha.find('td:nth-child(10)').text());
				$('#valor_recebido').attr('readonly', true).val("0,00");
			});
			$('.visualizar').click(function() {
				var id = $(this).data('id');
				var token = "{{ csrf_token() }}";

				$.post('/historico', { dataId: id, _token: token })
				.done(function(vendaDetalhes, vendaTransaction) {
					$('#table-vendaDetalhe tbody').empty();

					$.each(vendaDetalhes, function(index, venda) {
						$('#id_transacao').val(venda.id_transacao);
						var valorItemFormatted = parseFloat(venda.valor_item).toLocaleString('pt-br', {minimumFractionDigits: 2});
						var totalVendaFormatted = parseFloat(venda.total_venda).toLocaleString('pt-br', {minimumFractionDigits: 2});
						var newRow =
							'<tr>' +
								'<td>' + venda.id_transacao + '</td>' +
								'<td>' + venda.nome_produto + '</td>' +
								'<td>' + venda.quantidade + '</td>' +
								'<td>' + valorItemFormatted + '</td>' +
								'<td>' + totalVendaFormatted + '</td>' +
							'</tr>';
						$('#table-vendaDetalhe tbody').append(newRow);
					});
					$('.pagamento').text($('#transations-table tbody').find('td:eq(3)').text());
					$('.parcela').text($('#transations-table tbody').find('td:eq(6)').text());
					$('.valor_parcela').text($('#transations-table tbody').find('td:eq(7)').text());
					$('#modalHistorico').modal('show');
				})
				.fail(function(error) {
					console.error(error);
				});
			});


			$('.excluir').click(function() {
				var transacaoId = $(this).data('id');
				$('#modalExcluir').modal('show');
				$('#idExcluir').val(transacaoId);
				const rota = "{{route('historico.excluir')}}";
				$('#formExcluir').attr('action', rota);
			});

			var tabela = $('#transations-table');
			var numCliente = tabela.find('tbody').find('tr').length;
			if(numCliente > 7){
				tabela.parent().css('max-height', '400px').css('overflow-y', 'auto');
			}
			else{
				tabela.parent().css('max-height', 'none').css('overflow-y', 'visible');
			}
		});

		function closePrint () {
				document.body.removeChild(this.__container__);
			}
		function setPrint () {
			this.contentWindow.print();
		}

		function imprimirConteudo(url) {
			var newFrame = document.createElement("iframe");
			newFrame.onload = setPrint;
			newFrame.style.visibility = "hidden";
			newFrame.style.position = "fixed";
			newFrame.style.right = "0";
			newFrame.style.bottom = "0";
			newFrame.src = url;
			document.body.appendChild(newFrame);
		}

	</script>
@endpush
