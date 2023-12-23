@extends('adminlte::page')

@section('title', 'Backup dos Registros')
@section('css')
    <style>
        .progressBar{
            background-color: #dadada;
            height: 10px;
                
        }
        .progress-bar{
            background-Color:green;
        }
        .color-green{
            color:green;
        }
        .container{
            display:flex;
            justify-content: center;
        }
        .box-parent{
            margin:2rem;
        }
        .btn{
            margin-bottom:2rem;
            border-radius:20px
        }
        .box p {
            margin:2rem;
        }
        
        .cor-fundo{
            background-color: #0A8DC6;
            padding: 30px 10px 30px 10px;
            border-radius: 10px;
            color:white;
        }
    </style> 
@stop
@section('content_header')
<div class="row cor-fundo">
    {{-- <div class="col-md-4">
        <form action="{{ route('clientes.search') }}" method="GET" class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Pesquisar clientes" name="query">
                <div class="input-group-append">
                    <button style="border: solid 1px rgb(0, 0, 0); color: black; background-color:white;" class="btn btn-outline-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div> --}}
    <div class="col-md-12 ">
        <h3>BACKUP DOS REGISTROS DO SISTEMA</h3>
    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 box-parent">
            <div class="box box-danger text-center">
                <h3 class="header">Restaurar Database</h3>
                <p>Restaura de um arquivo .SQL os registro. Isso irá apagar os registros de seu banco de dados atual!</p>
                    <button class="btn btn-danger" onclick="">IMPORTAR</button>
                    <form id="form_import" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="file-sql" type="file" name="file-sql" style="display: none;" />
                    </form>
                    
                <div class="col-md-12 text-center">
                </div>
            </div> 
        </div>
        <div class="col-md-4 box-parent">
            <div class="box box-success text-center">
                <h3 class="header">Exportar Database</h3>
                <p>Salva todos os registro do seu banco de dados em um arquivo .SQL</p>
                    <a  href="#" ><button class="btn btn-primary" type="button">EXPORTAR</button></a>
                </div>
            </div>
        </div>
    </div>
@stop