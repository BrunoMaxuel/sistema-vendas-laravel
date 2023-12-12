@extends('adminlte::page')

@section('title', 'Gerenciamento de Caixa')

@section('content')
<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog " role="document">
	  	<div class="modal-content p-4">
			<div id="modalHeader" class="modal-header">
				<h2 class="modal-title" id="myModalLabel">Fechamento do Caixa</h2>
				
			</div>
			<div id="modalBody"class="modal-body">
				<h4>O saldo atual do caixa é : <strong>R${{$caixa->total}}</strong></h4>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" id="btnSubmit"class="btn btn-success  p-2 pl-4 pr-4" >Fechar o caixa</button>
				<button type="button" id="btnModal"class="btn btn-info p-2 pl-5 pr-5" data-dismiss="modal">Cancelar</button>
			</div>
	  	</div>
	</div>
</div>
  <x-modalMsg.modalCaixa/>
  <x-modalMsg.modalMsg/>
<div class="row p-3">
	<div class="col-sm-3">
		<div class="small-box bg-green">
			<div class="inner p-3">
				<h5> Total  do caixa <br> 
					<h4>R${{$caixa->total}}</h4> </h5>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="small-box bg-green">
			<div class="inner p-3">
				<h5>Total em crédito <br> 
					<h4>R${{$caixa->totalCredito}}</h4></h5>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="small-box bg-green">
			<div class="inner p-3">
				<h5>Total em débito <br> 
					<h4>R${{$caixa->totalDebito}}</h4></h5>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="small-box bg-green">
			<div class="inner p-3">
				<h5>Total em cartões <br> 
					<h4>R${{$caixa->totalCreditoDebito}}</h4> </h5>
			</div>
		</div>
	</div>
	<button class="btn btn-info m-2" id="close">Fechar o caixa</button>
	<button class="btn btn-success m-2" id="btnAdd">Suprimento</button>
	<button class="btn btn-danger m-2" id="btnRemove">Sangria de caixa</button>
</div>
	

  
  <hr>
  <div class="row">
	  <div class="col-md-12">
	  <h4>Movimentações do caixa</h4>
		 <table id="transations-table" class="table hover order-column compact table-bordered" cellspacing="0" width="100%">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Data de movimento</th>
					<th scope="col">Cliente</th>
					<th scope="col">Descrição</th>
					<th scope="col">Desconto</th>
					<th scope="col">Pagamento</th>
					<th scope="col">Total R$</th>
				</tr>
			</thead>
			<tbody>
			  	<tr>
					<td>-</td>
					<td>{{$caixa->created_at}}</td>
					<td>-</td>
					<td>{{$caixa->descricao}}</td>
					<td>-</td>
					<td>-</td>
					<td>+{{$caixa->valor_inicial}}</td>
				</tr>
				@foreach($entrada as $entradas)
					<tr class="bg-success">
						<td>-</td>
						<td>{{$entradas->created_at}}</td>
						<td>-</td>
						<td>{{$entradas->descricao}}</td>
						<td>-</td>
						<td>-</td>
						<td>+{{$entradas->valor}}</td>
					</tr>
			  	@endforeach
			  	@foreach($transacoes as $transations)
					<tr class="bg-success">
						<td>{{$transations->id}}</td>
						<td>{{$transations->created_at}}</td>
						<td>{{$transations->cliente}}</td>
						{{-- <td><a target="_blank" href="{{route('venda.cupom', ['id'=>$transations->id])}}">{!!nl2br($transations->detalhes)!!}</a></td> --}}
						<td> Venda </td>
						<td>{{$transations->desconto}}</td>
						<td>{{$transations->pagamento}}</td>
						<td>+{{$transations->total}}</td>
					</tr>
			  	@endforeach
			  	@foreach($sangria as $transations)
					<tr style="background-color: rgb(250, 100, 100)">
						<td>-</td>
						<td>{{$transations->created_at}}</td>
						<td>-</td>
						<td>{{$transations->descricao}}</td>
						<td>-</td>
						<td>-</td>
						<td>-{{$transations->valor}}</td>
					</tr>
			  @endforeach
			</tbody>
		  </table>
	  </div>
  </div>
@stop

@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script src="{{ asset('vendor/datatables.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
    	$.ajaxSetup({
    		  headers: {
    		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		  }
    		});
        $('#close').click(function(){
        	$('#modalAlert').modal('show');
        });
        $('#btnAdd').click(function(){
			$('#addOrSangria').val('add');
        	$('#title').html('Adicionar dinheiro do caixa');
			$('#text-label').html('Insira o valor que deseja adicionar:');
        	$('#modalCaixa').modal('show');
        });
        $('#btnRemove').click(function(){
			$('#addOrSangria').val('sangria');
			$('#title').html('Retirar dinheiro do caixa');
			$('#text-label').html('Insira o valor de retirada:');
        	$('#modalCaixa').modal('show');
        });
		
    	
    	 $('#transations-table').DataTable( {
    		 "bPaginate": false,
			 "columnDefs": [
				{ "orderable": false, "targets": 1 } // O índice da coluna começa de 0
			],
 	        "language": {
 	            "lengthMenu": "Exibir _MENU_ registros por página",
 	            "zeroRecords": "Nada encontrado",
 	            "info": "Exibindo _PAGE_ de _PAGES_",
 	            "infoEmpty": "Nenhum registro encontrado",
 	            "infoFiltered": "(filtrado de _MAX_ todos os registros)",
 	            "search" : " Pesquisar "
 	        },
 	       "initComplete": function( settings, json ) {
 	            $('.bg-success').css('background-color','#dff0d8');
 	           	$('.bg-danger').css('background-color','#f2dede');
 	            }
    	    });
 	    $('#btnSubmit').click(function(){
				$.post("{{route('caixa.fechar')}}", function( data ){
					if(data.success == true){
						$('#modalAlert').modal('hide');
						$('#modal-msg').modal('show');
						$("#background-text").addClass("bg-success");
						$("#titulo-msg").html(data.message);
						setTimeout(function() {
							window.location.reload(); 
						}, 1100); 
					}
					else{
						$('#modal-msg').modal('show');
						$("#background-text").addClass("bg-success");
						$("#titulo-msg").html(data.message);
						setTimeout(function() {
							window.location.reload(); 
						}, 1100); 
					}
				}
     		);
 	    });
 	    $('#btnAction').click(function(){
				$valor = $('#valor').val();
				$descricao = $('#descricao').val();
				$addOrSangria = $('#addOrSangria').val();
				console.log($addOrSangria);
				if($addOrSangria == 'add'){
					$.post("{{route('caixa.add')}}", {valor: $valor, descricao: $descricao} , function( data ){
							if(data.success == true){
								$('#modalCaixa').modal('hide');
								$('#modal-msg').modal('show');
								$("#background-text").addClass("bg-success");
								$("#titulo-msg").html(data.message);
								setTimeout(function() {
									window.location.reload(); 
								}, 1100); 
							}
						}
					 );
				}
				else
				{
					$.post("{{route('caixa.sangria')}}", {valor: $valor, descricao: $descricao} , function( data ){
						if(data.success == true){
							$('#modalCaixa').modal('hide');
							$('#modal-msg').modal('show');
							$("#background-text").addClass("bg-success");
							$("#titulo-msg").html(data.message);
							setTimeout(function() {
								window.location.reload(); 

								}, 1100); 
							}
						}
     				);
				}
 	    	});
    	});
</script>
@stop