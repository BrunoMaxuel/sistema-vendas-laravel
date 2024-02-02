@extends('adminlte::page')
@section('title') Dashboard @endsection
@section('content_header') 
    <div class="row">
        <div class="col-sm-4">
            <a href="">
                <div class="small-box bg-green p-4">
                    <div class="inner">
                        <h1>{{ count($transacoes )}}</h3>
                        <h5>Vendas desse mês</h5>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{route('produto.index')}}">
                <div class="small-box bg-info p-4">
                    <div class="inner">
                        <h1>{{count($produtos)}} </h3>
                        <h5>Produtos em estoque</h5>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{route('cliente.index')}}">
                <div class="small-box bg-yellow p-4">
                    <div class="inner">
                        <h1>{{count($clientes)}}</h3>
                        <h5>Clientes Cadastrados</h5>   
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection  
