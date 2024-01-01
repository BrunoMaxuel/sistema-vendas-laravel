<div class="table-responsive">
    <table id="tabela-produto" class="custom-table table table-striped align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Codigo Barras</th>
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
                                    <x-form.button id="{{$produto['id']}}" class="btnEditar mr-2" type="submit" theme="success" icon="fas fa-edit" label="" />
                                </div>
                                <div>
                                    <x-form.button id="{{$produto['id']}}" class="btnExcluir" type="submit" theme="danger" icon="fas fa-trash" label="" />
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
