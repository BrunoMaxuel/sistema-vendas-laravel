<div>
    <h4>Total de clientes: {{count($clientes)  }} </h4>
</div>
<div id="btnAdd" class="btn btn-success m-1">
    Adicionar Cliente
</div>
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
                                <button type="button" id="{{$cliente['id']}}" class="btnExcluir btn btn-danger btn-sm mt-2 mt-sm-0">
                                <i class="bi bi-trash"></i> Excluir
                                </button>
                            </div>
                        </div>
                        
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center">Nenhum usuário encontrado</td>
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
@section('js')
    <script>
        $(document).ready(function() {
            $('#btnAdd').click(function() {
                window.location.href = '/clientes/adicionar';
            });
        });
    </script>


@stop