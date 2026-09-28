@extends('layout.dashboard')

{{-- Alteração da Gabriele - essa página já possui o próprio cabeçalho --}}
@section('show-page-header', false)

@section('title', 'Idosos')

@section('content')
    @include('admin.idoso.listaIdoso')
@endsection