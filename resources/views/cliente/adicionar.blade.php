@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Adicionar Cliente</h1>
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Exibição de mensagem apos excluir ou alterar --}}
<x-cliente.msgReturn/>
@stop

