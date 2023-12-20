<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Cdigo Barras</th>
            <th scope="col">Preço</th>
            <th scope="col">Custo</th>
            <th scope="col">Lucro</th>
            <th scope="col">Estoque</th>
            <th scope="col">Fornecedor</th>
            <th scope="col">Categoria</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @if(count($produtos) > 0)
            @foreach($produtos as $produto)
                <tr>
                    <th scope="row">{{$produto['id']}}</th>
                    <td><strong>{{$produto['nome']}}</strong></td>
                    <td>{{$produto['codigo_barras']}}</td>
                    <td>{{number_format($produto['preco'], 2, ',', '.')}}</td>
                    <td>{{number_format($produto['preco_custo'], 2, ',', '.')}}</td>
                    <td>{{$produto['lucro'].'%'}}</td>
                    <td>{{$produto['estoque']}}</td>
                    <td>{{$produto['fornecedor']}}</td>
                    <td>{{$produto['categoria']}}</td>
                    <td>
                        <div class="btn-group">
                            <div>
                                <button type="button" id="{{$produto['id']}}"  class="btnEditar btn btn-secondary-soft btn-sm btn-success mr-2">
                                <i class="bi bi-pencil-square"></i> Editar
                                </button>
                            </div>
                            <div>
                                <button type="button" id="{{$produto['id']}}" class="btnExcluir btn btn-danger btn-sm mt-2 mt-sm-0">
                                <i class="bi bi-trash"></i> Excluir
                                </button>
                            </div>
                        </div>
                        
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center">Nenhum produto encontrado</td>
            </tr>
        @endif
        </tbody>
    </table>
    </div>
    </div>
        <div class="d-flex justify-content-center">
            {{ $produtos->links('pagination::bootstrap-4') }}
        </div>
    </div>