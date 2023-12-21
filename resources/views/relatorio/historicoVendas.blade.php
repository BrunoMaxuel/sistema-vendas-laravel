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
	<div class="row cor-linha">
		<div class="col-md-5">
			<h2>Histórico de Vendas</h2>
		</div>
		<div class="col-md-7 d-flex justify-content-end">
			<button id="comprovanteGen" class="btn btn-light p-2 mr-3">Comprovante de venda<span class="glyphicon glyphicon-print"></span></button>
			<button type="submit" class="btn btn-light p-2">Imprimir Vendas<span class="glyphicon glyphicon-print"></span></button>
		</div>
	</div>
	
		<table id="transations-table" class="table hover order-column compact table-bordered" cellspacing="0" width="100%">
			<thead class="thead-light">
			<tr>
				<th scope="col">N°</th>
				<th scope="col">Cliente</th>
				<th scope="col">Data</th>
				{{-- <th scope="col">Desc(%)</th> --}}
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
					{{-- <td>{{$transacao->pagamento}}</td> --}}
					<td>{{$transacao->total_item}}</td>
					<td>{{$transacao->parcela}} x {{$transacao->valor_parcela}}</td>
					<td>{{$transacao->total}}</td>
					<td>
						<i style="cursor: pointer; background-color:#ddd; border-radius:4px; padding: 10px;" class="fas fa-eye text-blue visualizar"></i>

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
            console.log('Clicou no ícone de visualização!');
        });
        $('.editar').click(function() {
            console.log('Editando...');
        });
        $('.excluir').click(function() {
            console.log('Excluindo');
        });
    });
</script>
@stop