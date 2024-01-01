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
            padding: 20px 5px 20px 5px;
            border-radius: 10px;
            color:white;
        }
    </style> 
@stop
@section('content_header')
<div class="row cor-fundo">
    <div class="col-md-12 ">
        <h3><strong>Backup e restauração do sistema</strong></h3>
    </div>
</div>
@stop

@section('content')
    <x-modalMsg.modalMsg/>
    @if(session('msg'))
        <script>
            showModal(session('msg'));
        </script>
    @endif

    <div class="row">
        
        <div class="col-md-5 cor-fundo">
            <div class="box box-danger text-center">
                <h3 class="header">Restaurar Database</h3>
                <p>Isso vai redefinir todos os seus dados do sistema.</p>
                    <button class="btn btn-danger pl-5 pr-5" onclick="importData()">IMPORTAR</button>
                    <form id="form_import" action="{{ route('backup.importBackup')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="file-sql" type="file" name="file-sql" style="display: none;" />
                    </form>
                    {{-- {{ isset($import) ? $import : '' }} --}}
                <div class="col-md-12 text-center">
                </div>
            </div> 
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-5 cor-fundo">
            <div class="box box-success text-center">
                <h2 class="header">Exportar Database</h2>
                    <p>Isso gera um arquivo com os dados do sistema.</p>
                        <a download="{{$mysql->filename}}" href="data:application/octet-stream;base64,{{$mysql->file}}" ><button class="btn btn-success pl-5 pr-5" type="button">EXPORTAR</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        @if(session('msg'))
            showModal('{{ session('msg') }}');
        @endif
        document.getElementById('file-sql').value = '';

        document.getElementById('file-sql').onchange = function(e){
            $("#background-text").addClass("bg-blue");
            $("#titulo-msg").css('font-size', 23);
            $("#titulo-msg").html("Restaurando dados, aguarde...");
            $('#modal-msg').modal('show');
            document.getElementById('form_import').submit();
        }

        function importData(){
            document.getElementById('file-sql').click();
        }
        function showModal(msg){
            $("#background-text").addClass("bg-success");
            $("#titulo-msg").css('font-size', 20);
            $("#titulo-msg").html(msg);
            setTimeout(function() {
                    $('#modal-msg').modal('show');
            }, 500); 
            setTimeout(function() {
                    $('#modal-msg').modal('hide');
            }, 3000); 
        }
    </script>
@stop