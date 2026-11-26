@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Modifier l'article</h1>
                    <div class="small text-truncate" style="color: var(--admin-muted); max-width: 70ch;">{{ $article->title }}</div>
                </div>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-admin-ghost">Retour aux articles</a>
            </div>

            @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="fw-semibold mb-1">Veuillez corriger les erreurs :</div>
                    <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.articles._form')
            </form>
        </div>
    </div>
@endsection
