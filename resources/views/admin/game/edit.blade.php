@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Modifier {{ $participant->public_name }}</h1>
                    <div class="small" style="color: var(--admin-muted);">Les changements du nom, de la photo ou du cadeau régénèrent automatiquement le badge.</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('game.show', $participant) }}" target="_blank" class="btn btn-admin-ghost">Voir la page publique</a>
                    <a href="{{ route('admin.game.index') }}" class="btn btn-admin-ghost">Retour</a>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.game.update', $participant) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-12 col-lg-8">
                        <div class="admin-card p-4 mb-3">
                            <div class="fw-bold mb-3">Informations du participant</div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $participant->lastname) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Prénom(s)</label>
                                    <input type="text" name="firstnames" class="form-control" value="{{ old('firstnames', $participant->firstnames) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nom public</label>
                                    <input type="text" name="public_name" class="form-control" value="{{ old('public_name', $participant->public_name) }}" maxlength="60" required>
                                    <div class="form-text" style="color:var(--admin-muted);">Le lien public reste inchangé pour préserver les partages existants.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">WhatsApp</label>
                                    <input type="tel" name="whatsapp" class="form-control" value="{{ old('whatsapp', $participant->whatsapp) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ville / Commune</label>
                                    <input type="text" name="city" class="form-control" value="{{ old('city', $participant->city) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nombre de soutiens</label>
                                    <input type="number" name="supports_count" class="form-control" value="{{ old('supports_count', $participant->supports_count) }}" min="0" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Cadeau souhaité</label>
                                    <select name="prize" class="form-select" required>
                                        @foreach($prizes as $prize)
                                            <option value="{{ $prize }}" @selected(old('prize', $participant->prize) === $prize)>{{ $prize }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="admin-card p-4">
                            <div class="fw-bold mb-3">Photo</div>
                            <div class="d-flex flex-column flex-md-row align-items-md-center gap-4">
                                <div style="width:140px;height:140px;border-radius:50%;overflow:hidden;background:#00234D;border:4px solid #ec4899;flex:0 0 140px;">
                                    @if($participant->photo)
                                        <img id="participantPhotoPreview" src="{{ asset($participant->photo) }}" alt="Photo de {{ $participant->public_name }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <div id="participantPhotoFallback" class="w-100 h-100 d-flex align-items-center justify-content-center" style="font-size:48px;font-weight:800;color:#fff;">{{ mb_strtoupper(mb_substr($participant->public_name, 0, 1)) }}</div>
                                        <img id="participantPhotoPreview" src="" alt="" style="width:100%;height:100%;object-fit:cover;display:none;">
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <label class="form-label">Remplacer la photo</label>
                                    <input type="file" name="photo" id="participantPhotoInput" class="form-control" accept="image/*">
                                    <div class="form-text" style="color:var(--admin-muted);">JPG, PNG ou WebP, 4 Mo maximum.</div>
                                    @if($participant->photo)
                                        <div class="form-check mt-3">
                                            <input type="hidden" name="remove_photo" value="0">
                                            <input class="form-check-input" type="checkbox" name="remove_photo" value="1" id="removePhoto">
                                            <label class="form-check-label" for="removePhoto">Supprimer la photo actuelle</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="admin-card p-4 position-sticky" style="top:100px;">
                            <div class="fw-bold mb-3">Badge actuel</div>
                            @if($participant->badge_path)
                                <img src="{{ asset($participant->badge_path) }}" alt="Badge de {{ $participant->public_name }}" class="w-100 rounded-3 mb-3" style="border:1px solid var(--admin-border);">
                            @else
                                <div class="rounded-3 p-5 text-center mb-3" style="background:#00234D;color:#fff;">Aucun badge</div>
                            @endif
                            <div class="small mb-4" style="color:var(--admin-muted);">En enregistrant, le badge sera régénéré avec les informations et la photo mises à jour.</div>
                            <button type="submit" class="btn btn-admin-primary w-100">Enregistrer et régénérer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('participantPhotoInput');
                const preview = document.getElementById('participantPhotoPreview');
                const fallback = document.getElementById('participantPhotoFallback');
                if (!input || !preview) return;
                input.addEventListener('change', function () {
                    const file = this.files && this.files[0];
                    if (!file || !file.type.startsWith('image/')) return;
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                    if (fallback) fallback.style.display = 'none';
                });
            });
        </script>
    @endpush
@endsection
