@extends('adminlte::page')

@section('title', 'Histórico de vendas')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}"/>
@stop

@section('content')
	<div class="row bg-success p-4 border rounded">
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
			<th scope="col">#</th>
			<th scope="col">Cliente</th>
			<th scope="col">Data</th>
			<th scope="col">Itens Qnt Valor</th>
			<th scope="col">Desconto</th>
			<th scope="col">Pagamento</th>
			<th scope="col">Parcelas</th>
			<th scope="col">Valor parcelas</th>
			<th scope="col">Total R$</th>
			<th scope="col">Ação</th>
		</tr>
		</thead>
	</table>
@stop
@section('js')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script src="{{ asset('vendor/datatables.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
    	moment.locale('pt-BR');
    	  $("#print_form").val($('#data').val());
    	 var table = $('#transations-table').DataTable( {
    		 "bPaginate": true,
 	        "language": {
 	            "lengthMenu": "Exibir _MENU_ registros por página",
 	            "zeroRecords": "Nada encontrado",
 	            "info": "Exibindo _PAGE_ de _PAGES_",
 	            "infoEmpty": "Nenhum registro encontrado",
 	            "infoFiltered": "(filtrado de _MAX_ todos os registros)",
 	            "search" : "Procurar",
 	        },
 	       "ajax": {
            	"url":"/nada", 
           		"dataSrc": ""
   	        },
   	      "columns": [
   	            { "data": "id" },
   	            { "data": "cliente" },
   	            { "data": "data" },
   	            { "data": "detalhes"},
   	            { "data": "desconto" },
   	            { "data": "pagamento"},
   	            { "data": "parcelas" },
   	            { "data": "valor_parcelas" },
   	            { "data": "total" },
   	         	{ "data": null },
   	        ],
   	     "columnDefs": [ {
             "targets": -1,
             "data": null,
             "defaultContent": "<button class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button>"
         } ]
   	    });
    	 $('#transations-table tbody').on( 'click', 'button', function () {
    	        var data = table.row( $(this).parents('tr') ).data();
    	        $("#modalHeader").removeClass('alert-success').addClass("modal-header alert alert-danger");
    	        $("#modalHeader").html('<h4>Deseja realmente cancelar esta venda?</h4>');
    			$("#modalBody").html('<form id="delForm">{{csrf_field()}}<input type="hidden" name="id" value="'+data.id+'"/><label><input type="checkbox" name="return_estoque" value="true" checked/>RETORNAR MERCADORIA AO ESTOQUE</label><br><label><input type="checkbox" id="rt_cx" name="return_caixa" value="true" checked/>DESCONTAR DINHEIRO DO CAIXA</label><br><label><input id="rt_fc" type="checkbox" name="return_fechamento" value="true"/>REGISTRAR NO FECHAMENTO</label></form>');
    			$("#rt_cx").change(function(){
    	 	 		if($(this).is(":checked")){
    	 	 			 $("#rt_fc").prop("disabled",false);
    	 	 		}else{
    	 	 			$("#rt_fc").prop("disabled",true);
    	 	 		}
    	 		});
    			$("#btnSubmit").show();
    			$("#btnCancel").html("SAIR");
    			$("#btnSubmit").html("Continuar");
    			$('#modalAlert').modal({backdrop: 'static', keyboard: false}) 
    			$('#modalAlert').modal('show');
    			$("#btnSubmit").click(function (){
        			 $(this).hide();
        			 submitF();
        		});
    	    } );
    	 function submitF(){
        	 var data = $('#delForm').serialize();
    		 $("#modalHeader").html('<h4>Processando</h4>');
			 $("#modalBody").html("Processando pedido aguarde");
				$.post("{{ route('venda.cancelar') }}",data,function(data){
					if(data.success == 'true'){
	        			$("#modalHeader").removeClass('alert-danger').addClass("modal-header alert alert-success");
	        			$("#modalHeader").html('Sucesso!');
	        			$("#modalBody").html(data.message);
	        			$("#btnCancel").html("OK");
	        			$("#btnCancel").show();
	        			$("#btnSubmit").hide();
	        			$("#btnCancel").click(function(){
		        			table.ajax.reload();
	        			});
	    	    	}
	    			else{
	    				$("#modalHeader").removeClass('alert-success').addClass("modal-header alert alert-danger");
	    				$("#myModalLabel").html("ERRO!");
	    				$("#btnSubmit").remove();
	        			$("#modalBody").html(data.message);
	        			$("#btnCancel").show();
	        			$("#btnCancel").html('OK');
	    			}
				}, "json"
			);
		}
 		
    	function closePrint () {
    		  document.body.removeChild(this.__container__);
    	}
    	function setPrint () {
   		  this.contentWindow.__container__ = this;
   		  this.contentWindow.onbeforeunload = closePrint;
   		  this.contentWindow.onafterprint = closePrint;
   		  this.contentWindow.focus(); // Required for IE
   		  this.contentWindow.print();
   		}

   		function printPage (sURL) {
   		  var oHiddFrame = document.createElement("iframe");
   		  oHiddFrame.onload = setPrint;
   		  oHiddFrame.style.visibility = "hidden";
   		  oHiddFrame.style.position = "fixed";
   		  oHiddFrame.style.right = "0";
   		  oHiddFrame.style.bottom = "0";
   		  oHiddFrame.src = sURL;
   		  document.body.appendChild(oHiddFrame);
   		}
    	$('#transations-table tbody').on( 'click', 'tr', function () {
    	        if ( $(this).hasClass('selected') ) {
    	            $(this).removeClass('selected');
    	        }
    	        else {
    	            table.$('tr.selected').removeClass('selected');
    	            $(this).addClass('selected');
    	        }
    	    } );
    	 
    	    $('#comprovanteGen').click( function () {
    	    	printPage();
    	    } );

 	   	var start = moment().subtract(29, 'days');
 	    var end = moment();

 	    function cb(start, end) {
 	        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
 	        $("#print_form").val(start.format('YYYY-MM-DD')+','+end.format('YYYY-MM-DD'));
 	       	table.ajax.url("/"+start.format('YYYY-MM-DD')+','+end.format('YYYY-MM-DD'));
			table.ajax.reload();
 	    }
 	    $('#reportrange').daterangepicker({
 	        startDate: start,
 	        endDate: end,
 	       locale: { cancelLabel: 'Cancelar',
 	    	  		 applyLabel: 'Aplicar',
 	    	  		customRangeLabel:  'Outra data'}  ,
 	        ranges: {
 	           'Hoje': [moment(), moment()],
 	           'Otem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
 	           'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
 	           'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
 	           'Este mês': [moment().startOf('month'), moment().endOf('month')],
 	           'Último mês': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
 	        }
 	    }, cb);
 	    cb(start, end);
 	    
    });
</script>
@stop