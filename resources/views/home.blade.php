@extends('adminlte::page')
@section('title') Dashboard @endsection
@section('content_header') 
    <div class="row">
        <div class="col-sm-4">
            <div class="small-box bg-green">
                <div class="inner">
                    
                    <h3>{{ count($transacoes )}}</h3>
                    <h5>Vendas desse mês</h5>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <a href="" class="small-box-footer p-2" style="font-size: 20px">Abrir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{count($produtos)}} </h3>
                    <h5>Produtos em estoque</h5>
                </div>
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <a href="{{route('produto.index')}}" class="small-box-footer p-2" style="font-size: 20px">Abrir estoque <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{count($clientes)}}</h3>
                    <h5>Clientes Cadastrados</h5>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{route('cliente.index')}}" class="small-box-footer p-2" style="font-size: 20px">Clientes <i class="fa fa-arrow-circle-right"></i></a>
                
            </div>
        </div>
    </div>
@endsection  
