@extends('adminlte::page')

@section('title', 'Histórico de vendas')
@section('css')
	<style>
		.cor-linha{
			background-color: #0A8DC6;
			color:white;
			padding: 15px;
			border-radius: 5px;
		}
		.custom-table {
        border-collapse: collapse;
        width: 100%;
    }

    .custom-table th,
    .custom-table td {
        padding: 4px; /* Ajuste o valor conforme necessário */
        text-align: left;
        border-bottom: 1px solid #ddd; /* Adicione uma borda inferior para separar as linhas */
    }
	</style>
@stop
@section('content_header')
	<div class="row cor-linha">
		<div class="col-md-6">
			<h3>Histórico de Vendas</h3>
		</div>
		<div class="col-md-3 ">
			{{-- <button onclick="imprimirConteudo('historico/imprimirVendas')" class="btn btn-light">Imprimir Histórico</button> --}}
		</div>
		<div class="col-md-3 ">
			<x-form.button onclick="imprimirConteudo('historico/imprimirVendas')" type="button" theme="light"  label="Imprimir Histórico" />
		</div>
	</div>
@stop
@section('content')
	<x-modalMsg.modalHistorico/>	
	<div class="table-responsive">
		<table id="transations-table" class="custom-table table hover order-column compact table-bordered" cellspacing="0" width="100%">
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
						<x-form.button class="visualizar" data-id="{{$transacao->id}}" type="button" theme="primary" icon="fas fa-eye" label="" />
						<x-form.button class="editar" data-id="{{$transacao->id}}" type="button" theme="success" icon="fas fa-edit" label="" />
						<x-form.button class="excluir" data-id="{{$transacao->id}}" type="button" theme="danger" icon="fas fa-trash-alt" label="" />
						
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>	
	</div>
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
					$('#id_transacao').val(venda.id_transacao);
					var valorItemFormatted = parseFloat(venda.valor_item).toLocaleString('pt-br', {minimumFractionDigits: 2});
					var totalVendaFormatted = parseFloat(venda.total_venda).toLocaleString('pt-br', {minimumFractionDigits: 2});
					var newRow = '<tr>' +
						'<td>' + venda.id_transacao + '</td>' +
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
		var tabela = $('#transations-table');
            var numCliente = tabela.find('tbody').find('tr').length;
            if(numCliente > 7){
                tabela.parent().css('max-height', '400px').css('overflow-y', 'auto');
            }
            else{
                table.parent().css('max-height', 'none').css('overflow-y', 'visible');    
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
@stop