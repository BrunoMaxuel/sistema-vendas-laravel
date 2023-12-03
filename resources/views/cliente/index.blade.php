@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Modal -->

<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="modalHeader" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalHeader">Alterar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUp">
          @csrf
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="nome">Nome do cliente</label>
            <input type="text" id="nomeCliente" maxlength="100" required="required" name="nome" class="form-control" placeholder="Nome">
          </div>
          <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Ex. Rua Brasil 999">
          </div>
          <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="tel" id="tel1" name="telefone" class="form-control" placeholder="Telefone">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="sexo">Sexo do cliente</label>
              <select id="sexo" name="sexo" class="form-control">
                <option value="I">Não especificado</option>
                <option value="F">Feminino</option>
                <option value="M">Masculino</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="cep">CEP</label>
              <input type="text" id="cep" name="cep" class="form-control" placeholder="CEP">
            </div>
          </div>
          <div class="form-row">
            
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="bairro">Bairro</label>
              <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro">
            </div>
            <div class="form-group col-md-6">
              <label for="cidade">Cidade</label>
              <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade">
            </div>
          </div>
          <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="uf" class="form-control">
              <option value="" selected>Selecionar</option>
            	<option value="AC">Acre</option>
            	<option value="AL">Alagoas</option>
            	<option value="AP">Amapá</option>
            	<option value="AM">Amazonas</option>
            	<option value="BA">Bahia</option>
            	<option value="CE">Ceará</option>
            	<option value="DF">Distrito Federal</option>
            	<option value="ES">Espírito Santo</option>
            	<option value="GO">Goiás</option>
            	<option value="MA">Maranhão</option>
            	<option value="MT">Mato Grosso</option>
            	<option value="MS">Mato Grosso do Sul</option>
            	<option value="MG">Minas Gerais</option>
            	<option value="PA">Pará</option>
            	<option value="PB">Paraíba</option>
            	<option value="PR">Paraná</option>
            	<option value="PE">Pernambuco</option>
            	<option value="PI">Piauí</option>
            	<option value="RJ">Rio de Janeiro</option>
            	<option value="RN">Rio Grande do Norte</option>
            	<option value="RS">Rio Grande do Sul</option>
            	<option value="RO">Rondônia</option>
            	<option value="RR">Roraima</option>
            	<option value="SC">Santa Catarina</option>
            	<option value="SP">São Paulo</option>
            	<option value="SE">Sergipe</option>
            	<option value="TO">Tocantins</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="btnCancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button id="btnSubmit" type="button" class="btn btn-primary">Salvar alterações</button>
      </div>
    </div>
  </div>
</div>


    <h4>Total de clientes: {{count($clientes)  }} </h4>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Endereço</th>
                <th scope="col">Telefone</th>
                <th scope="col">Bairro</th>
                <th scope="col">Cidade</th>
                <th scope="col">Estado</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @if(count($clientes) > 0)
                @foreach($clientes as $cliente)
                    <tr>
                        <th scope="row">{{$cliente['id']}}</th>
                        <td><strong>{{$cliente['nome']}}</strong></td>
                        <td>{{$cliente['endereco']}}</td>
                        <td>{{$cliente['telefone']}}</td>
                        <td>{{$cliente['bairro']}}</td>
                        <td>{{$cliente['cidade']}}</td>
                        <td>{{$cliente['estado']}}</td>
                        <td>
                            <div class="btn-group">
                                <div>
                                    <button type="button" id="{{$cliente['id']}}"  class="btnEditar btn btn-secondary-soft btn-sm btn-success mr-2">
                                    <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger btn-sm mt-2 mt-sm-0">
                                    <i class="bi bi-trash"></i> Excluir
                                    </button>
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">Nenhum usuário encontrado</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-end">
    {{-- {{$clientes->links()}} --}}
</div>
</div>
@stop

@section('js')
  <script type="text/javascript">
    $(function() {	
        $('.btnEditar').click(function() {

            $("#formUp")[0].reset();

            editar($(this).attr('id'));
        });
        function editar(index){
          $.post("{{route('clientes.editar')}}", { id: index, _token: $('meta[name="csrf-token"]').attr('content')}, function( data )	{
            console.log("asdasd");
                $("#id").val(data.id);
                $("#nome").val(data.nome);
                $("#sexo").val(data.sexo);
                $("#tel1").val(data.telefone);
                $("#endereco").val(data.endereco);
                $("#bairro").val(data.bairro);
                $("#cidade").val(data.cidade);
                $("#uf").val(data.estado);
          }, "json"
        );
        $('#modalAlert').modal('show');
      };
      $('#btnSubmit').click(function() {
          var dados = $("#formUp").serialize();
          $.post("{{route('clientes.saveEdit')}}",dados, function( data )	{

                  if(data.success == 'true'){
                      $("#modalHeader").addClass("modal-header alert alert-success");
                      $("#myModalLabel").html("Cliente editado com sucesso!");
                      $("#modalBody").html(data.message);
                      $("#btnSubmit").html("OK");
                      $("#btnCancel").remove();
                      $("#btnSubmit").click(function(){
                          window.location.reload(); 
                      });
                  }
                  else{
                    $("#modalHeader").addClass("modal-header alert alert-danger");
                    $("#myModalLabel").html("ERRO!");
                    $("#btnCancel").remove();
                      $("#modalBody").html(data.message);
                  }
                  $('#modalAlert').modal('show');
          }, "json"
        );
      });
    });
  </script>
@stop