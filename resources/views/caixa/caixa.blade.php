@extends('adminlte::page')

@section('title', 'Gerenciamento de Caixa')
@section('css')
	<style>
		.custom-table {
        border-collapse: collapse;
        width: 100%;
    	}	
		.cor-fundo{
			background-color: #0A8DC6;
			color: white;
		}
		.custom-table th,
		.custom-table td {
			padding: 7px; 
			text-align: left;
			border-bottom: 1px solid #ddd; 
		}
	</style>
@stop
@section('content_header')
	<x-componentsCaixa.modalCaixa/>
	<x-componentsCaixa.modalFechar total="{{$caixa->total}}" />
	<div class="row">
		<x-componentsCaixa.caixaConteudo title="Total do caixa" total="{{ number_format($caixa->total, 2, ',', '.') }}" />
		<x-componentsCaixa.caixaConteudo title="Total em Dinheiro" total="{{ number_format($caixa->dinheiro, 2, ',', '.') }}" />
		<x-componentsCaixa.caixaConteudo title="Total em Crédito" total="{{ number_format($caixa->totalCredito, 2, ',', '.') }}" />
		<x-componentsCaixa.caixaConteudo title="Total do Débito" total="{{ number_format($caixa->totalDebito, 2, ',', '.') }}" />
	</div>
	<div class="row">
		<div class="col-md-4">
			<div><h4>Movimentações do Caixa</h4></div>
		</div>
		<div class="col-md-8 d-flex justify-content-end">
			<button class="btn btn-info mr-2" id="close">Fechar o caixa</button>
			<button class="btn btn-success mr-2" id="btnAdd">Suprimento</button>
			<button class="btn btn-danger" id="btnRemove">Sangria de caixa</button>
		</div>
	</div>
@stop 
@section('content')
	<div class="row">
		<div class="col-md-12">
			<table id="transations-table" class="custom-table table compact table-bordered" width="100%">
				<thead class="thead-light">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Data e Hora</th>
						<th scope="col">Cliente ou Ações</th>
						<th scope="col">Descrição</th>
						<th scope="col">Desconto</th>
						<th scope="col">Pagamento</th>
						<th scope="col">Total R$</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>+</td>
						<td>{{$caixa->created_at}}</td>
						<td>+</td>
						<td>{{$caixa->descricao}}</td>
						<td>+</td>
						<td>+</td>
						<td>+{{number_format($caixa->valor_inicial, 2, ',', '.')}}</td>
					</tr>
					@foreach($caixa->suprimentos as $suprimento)
						<tr class="bg-success">
							<td>+</td>
							<td>{{$suprimento->created_at}}</td>
							<td> Adição de dinheiro </td>
							<td>{{$suprimento->descricao}}</td>
							<td>+</td>
							<td>+</td>
							<td>+{{number_format($suprimento->valor, 2, ',', '.')}}</td>
						</tr>	
					@endforeach
					@foreach($caixa->sangrias as $sangria)
					<tr style="background-color: rgb(250, 100, 100)">
						<td>-</td>
						<td>{{$sangria->created_at}}</td>
						<td> Subtração de Dinheiro </td>
						<td>{{$sangria->descricao}}</td>
						<td>-</td>
						<td>-</td>
						<td>-{{number_format($sangria->valor, 2, ',', '.')}}</td>
					</tr>
					@endforeach
					@foreach($caixa->transacoes as $transacao)
						<tr style="background-color: #0A8DC6; color: white;">
							<td> + </td>
							<td>{{$transacao->created_at}}</td>
							<td>{{$transacao->cliente}}</td>
							<td> Venda </td>
							<td>{{$transacao->desconto}}%</td>
							<td>{{$transacao->pagamento}}</td>
							<td>+{{number_format($transacao->total, 2, ',', '.')}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop

@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script type="text/javascript">
    $(function() {
    	$('#close').click(function(){
        $('#modalAlert').modal('show');
        });
        $('#btnAdd').click(function(){
			const rota = "{{route('caixa.add')}}";
			$('#formCaixa').attr('action', rota);
			$('#addOrSangria').val('add');
        	$('#title').html('Adicionar dinheiro do caixa');
			$('#text-label').html('Insira o valor que deseja adicionar:');
			$('#descricao').val('Adicionando dinheiro...');
        	$('#modalCaixa').modal('show');
        });
        $('#btnRemove').click(function(){
			const rota = "{{route('caixa.sangria')}}";
			$('#formCaixa').attr('action', rota);
			$('#addOrSangria').val('sangria');
			$('#title').html('Retirar dinheiro do caixa');
			$('#text-label').html('Insira o valor de retirada:');
			$('#descricao').val('Retirando dinheiro...');
        	$('#modalCaixa').modal('show');
        });
		var table = $('#transations-table');
		var numberOfRows = table.find('tbody').find('tr').length;
		if (numberOfRows > 5) {
			table.parent().css('max-height', '340px').css('overflow-y', 'auto');
		} else {
			table.parent().css('max-height', 'none').css('overflow-y', 'visible');
		}
	});
</script>
@stop