@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Modifier catégorie</h1>
                    <div class="small" style="color: var(--admin-muted);">{{ $category->name }}</div>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-admin-ghost">Retour</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="fw-semibold mb-1">Veuillez corriger les erreurs :</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="admin-card p-4">
                @csrf
                @method('PUT')
                @include('admin.categories._form')
            </form>
        </div>
    </div>
@endsection
