@extends('layout.site')

@section('content')

    @include('site.home.banner')
    
    @include('site.home.diferencial')

    @include('site.servico.servicos')

    @include('site.home.depoimento')

    @include('site.home.faq')

    @include('site.home.contato')

@endsection