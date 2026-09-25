@extends('layout.dashboard')

@section('show-page-header', false)

@section('title', 'Clientes')

@section('content')
    @include('admin.cliente.listarCliente')
@endsection