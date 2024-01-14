<div class="table-responsive">
    <table id="table-cliente" class="table table-striped align-middle">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Endereço</th>
            <th scope="col">Telefone</th>
            <th scope="col">Bairro</th>
            <th scope="col">Cidade</th>
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
                        <td>
                            <div class="btn-group">
                                <div>
                                    <x-form.button  id="{{$cliente['id']}}" class="btnEditar mr-2" type="submit" theme="success" icon="fas fa-edit" label="" />
                                </div>
                                <div>
                                    <x-form.button  id="{{$cliente['id']}}" class="btnExcluir" type="submit" theme="danger" icon="fas fa-trash" label="" />
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
