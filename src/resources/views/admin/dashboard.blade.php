@extends('layout.dashboard')
@section('title', 'Dashboard')
@section('content')
<div class="row g-3">
    @foreach ($totais as $titulo => $total)
        <div class="col-sm-6 col-xl-3"><div class="card shadow-sm"><div class="card-body"><div class="text-muted">{{ $titulo }}</div><strong class="fs-2">{{ $total }}</strong></div></div></div>
    @endforeach
</div>
@endsection
