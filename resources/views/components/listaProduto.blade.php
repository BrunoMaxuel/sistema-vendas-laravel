@push('css')
    <style>
        table tbody{
            border-collapse: collapse;
            height: 200px; 
            overflow-y: auto ; 
        }
    </style>
@endpush
<div class="table-responsive">
    <table id="tabela-produto" class="table table-bordered align-middle">
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
                        <td scope="row">{{$produto['id']}}</td>
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
@push('js')
    <script type="text/javascript" name="listaProduto" >
        $(document).on('click', '.btnEditar, .btnExcluir', function() {
            if ($(this).hasClass('btnEditar')) {
                var linhaTabela = $(this).closest('tr');
                $('#id_hidden').val(linhaTabela.find('td:eq(0)').text());
                $('#nome').val(linhaTabela.find('td:eq(1)').text());
                $('#codigo_barras').val(linhaTabela.find('td:eq(2)').text());
                $('#preco').val(linhaTabela.find('td:eq(3)').text()); 
                $('#preco_custo').val(linhaTabela.find('td:eq(4)').text());
                $('#categoria').val(linhaTabela.find('td:eq(8)').text()); 
                $('#lucro').val(linhaTabela.find('td:eq(5)').text()); 
                $('#estoque').val(linhaTabela.find('td:eq(6)').text()); 
                $('#fornecedor').val(linhaTabela.find('td:eq(7)').text()); 
                $('#modalAlert').modal('show');
                $("#formUp").attr("action", "{{ route('produto.editar') }}");
            } else if ($(this).hasClass('btnExcluir')) {
                $('#idExcluir').val($(this).attr('id')); 
                const rota = "{{route('produto.excluir')}}";
                $('#formExcluir').attr('action', rota);
                $('#modalExcluir').modal('show');
            }
        });

    </script>
@endpush