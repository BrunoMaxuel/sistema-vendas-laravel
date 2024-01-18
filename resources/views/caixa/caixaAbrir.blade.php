@extends('adminlte::page')

@section('title', 'Abertura de caixa')
@section('css')
	<style>
		.caixa{
			padding: 50px;
			background-color: #0A8DC6;
			color: white;
			border-radius: 10px;
		}
	</style>
@stop
@section('content')
	<div class="row p-3">
		<div class="col-md-5 caixa">
			<form id="abrirForm" method="POST" action="{{route('caixa.iniciar')}}"> 
				@csrf
				<div class="form-group text-center pb-3">
					<h3>Abertura de caixa</h3>
				</div>
				<div class="form-group">
					<label for="valor">Valor para iniciar o caixa <span class="text-danger">*</span></label>
					<input name="valor_inicial" class="form-control" placeholder="Insira o valor inicial do caixa..." data-mask="000.000,00" data-mask-reverse="true" required>
				</div>
				<div class="form-group">
					<label for="descricao">Informe uma descrição:</label>
					<input name="descricao" class="form-control" value="Saldo inicial" placeholder="Insira uma descrição (Opcional)" maxlength="30" >
				</div>
				<button type="submit" id="btnSubmit" class="btn btn-success mt-4 p-2 mb-5 btn-block ">
					Iniciar Caixa
				</button>
			</form>
		</div>
	</div>
@stop
@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script>
	$(function(){
		
	});
</script>
@stop