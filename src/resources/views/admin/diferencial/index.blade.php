@extends('layout.dashboard')
{{-- Esconde somente nesta página o cabeçalho "Dashboard / Menu / Dashboard" do layout. --}}
@section('show-page-header', 'false')
{{-- Título usado na aba do navegador e na identificação da página. --}}
@section('title', 'Diferenciais')

{{-- Inclui a tabela específica desta área dentro do layout administrativo. --}}
@section('content')
    @include('admin.diferencial.listaDiferencial')
@endsection
