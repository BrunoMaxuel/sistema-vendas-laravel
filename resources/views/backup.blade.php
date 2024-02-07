@extends('adminlte::page')

@section('title', 'Backup dos Registros')
@section('css')
    <style>
        .btn{
            padding: 10px 25px 10px 25px;
            border-radius:25px
        }
        .cor-fundo{
            background-color: #343A40;
            padding: 25px 5px 25px 5px;
            border-radius: 10px;
            color:white;
        }
    </style> 
@stop
@section('content_header')
    <div class="row pl-5 pr-5">
        <div class="col-md-11 cor-fundo d-flex justify-content-center">
            <h3><strong>Backup e restauração do sistema</strong></h3>
        </div>
        <div class="col-md-1">

        </div>
    </div>
@stop

@section('content')
    <x-modals.modalMsg/>
    @if(session('msg'))
        <script>
            showModal(session('msg'));
        </script>
    @endif
    <div class="row pr-5 pl-5">
        <div class="col-md-5 cor-fundo">
            <div class="box box-danger text-center">
                <h3 class="header">Restaurar Database</h3>
                <p>Isso vai redefinir todos os seus dados do sistema.</p>
                <x-form.button theme="danger" type="button" label="Inserir Arquivo"  onclick="importData()" />
                    <form id="form_import" action="{{ route('backup.importBackup')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="file-sql" type="file" name="file-sql" style="display: none;" />
                    </form>
            </div> 
        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-5 cor-fundo">
            <div class="box box-success text-center">
                <h2 class="header">Exportar Database</h2>
                <p>Isso gera um arquivo com os dados do sistema.</p>
                <x-form.button theme="success" type="button" label="Baixar Arquivo"  onclick="downloadFile('{{$mysql->filename}}', '{{$mysql->file}}');" />
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

        function downloadFile(filename, file) {
        const element = document.createElement('a');
        element.setAttribute('href', 'data:application/octet-stream;base64,' + file);
        element.setAttribute('download', filename);

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
    }
    </script>
@stop