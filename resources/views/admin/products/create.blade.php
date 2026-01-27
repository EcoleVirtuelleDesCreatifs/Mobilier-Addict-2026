@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Nouveau produit</h1>
                    <div class="small" style="color: var(--admin-muted);">Ajoute un produit au catalogue.</div>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-admin-ghost">Retour</a>
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

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="admin-card p-4">
                @csrf

                @include('admin.products._form', ['categories' => $categories])

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-admin-ghost">Annuler</a>
                    <button type="submit" class="btn btn-admin-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.ClassicEditor) {
                ClassicEditor.create(document.querySelector('#product_description')).catch(function () {});
            }
        });
    </script>
@endpush
