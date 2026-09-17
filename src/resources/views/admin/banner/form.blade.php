@extends('layout.dashboard')
@section('title', $banner->exists ? 'Editar banner' : 'Novo banner')
@section('content')
<div class="card shadow-sm"><div class="card-body"><form method="POST" enctype="multipart/form-data" action="{{ $banner->exists ? route('admin.banner.update', $banner) : route('admin.banner.store') }}">
@csrf @if($banner->exists) @method('PUT') @endif
<div class="mb-3"><label class="form-label" for="titulo_banner">Título</label><input class="form-control @error('titulo_banner') is-invalid @enderror" id="titulo_banner" name="titulo_banner" maxlength="35" value="{{ old('titulo_banner', $banner->titulo_banner) }}" required>@error('titulo_banner')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label class="form-label" for="img_banner">Imagem</label><input class="form-control @error('img_banner') is-invalid @enderror" id="img_banner" type="file" name="img_banner" accept="image/png,image/jpeg,image/webp" {{ $banner->exists ? '' : 'required' }}>@error('img_banner')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-3"><label class="form-label" for="status_banner">Status</label><select class="form-select" id="status_banner" name="status_banner"><option value="ATIVO" @selected(old('status_banner', $banner->status_banner) === 'ATIVO')>Ativo</option><option value="INATIVO" @selected(old('status_banner', $banner->status_banner) === 'INATIVO')>Inativo</option></select></div>
<a class="btn btn-outline-secondary" href="{{ route('admin.banner.index') }}">Cancelar</a><button class="btn btn-primary">Salvar</button>
</form></div></div>
@endsection
