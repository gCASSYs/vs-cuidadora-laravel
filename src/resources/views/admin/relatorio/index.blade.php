@extends('layout.dashboard')

{{-- tira o cabeçalho padrão pq essa página já tem o próprio cabeçalho --}}
@section('show-page-header', 'false')

{{-- título que aparece na aba do navegador --}}
@section('title', 'Relatórios')

{{-- chama a listagem dos relatórios --}}
@section('content')
    @include('admin.relatorio.listaRelatorio')
@endsection