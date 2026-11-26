@php
    $isEdit = isset($article) && $article && $article->exists;
    $status = old('status', $isEdit ? ($article->published_at ? 'published' : 'draft') : 'draft');
    $imageUrl = $isEdit && $article->image ? image_url($article->image) : null;
    $imageMissing = $imageUrl && str_contains($imageUrl, 'product-placeholder');
@endphp

@push('styles')
<style>
    .af-grid{display:grid;grid-template-columns:minmax(0,1fr) 340px;gap:20px;align-items:start}
    .af-side{position:sticky;top:76px;display:grid;gap:16px}
    .af-req{color:#e11d48;margin-left:2px}
    .af-hint{font-size:12px;color:var(--admin-muted);margin-top:4px}
    .af-count{font-size:12px;font-weight:400;color:var(--admin-muted);margin-left:auto}
    label:has(>.af-count){display:flex;align-items:baseline;gap:2px;width:100%}
    .af-count.is-bad{color:#e11d48}
    .af-title-input{font-size:22px;font-weight:600;padding:12px 14px}
    .af-slug{font-size:12px;color:var(--admin-muted);margin-top:6px;word-break:break-all}
    .af-status{display:grid;grid-template-columns:1fr 1fr;gap:6px;padding:4px;border-radius:12px;background:var(--admin-bg-subtle,#f1f5f9)}
    .af-status label{margin:0}
    .af-status input{position:absolute;opacity:0;pointer-events:none}
    .af-status span{display:block;padding:8px;border-radius:9px;text-align:center;font-size:13px;font-weight:600;cursor:pointer}
    .af-status input:checked+span{background:#fff;box-shadow:0 1px 4px rgba(0,0,0,.12)}
    .af-status input[value=published]:checked+span{color:#16a34a}
    .af-drop{position:relative;display:grid;place-items:center;min-height:170px;border:2px dashed var(--admin-border);border-radius:12px;overflow:hidden;text-align:center;cursor:pointer;color:var(--admin-muted);font-size:13px}
    .af-drop.is-over{border-color:#F0286E;background:rgba(240,40,110,.05)}
    .af-drop img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
    .af-drop input{position:absolute;inset:0;opacity:0;cursor:pointer}
    .af-stats{display:flex;gap:14px;font-size:12px;color:var(--admin-muted);margin-top:8px}
    .ck-editor__editable_inline{min-height:480px;font-size:16px;line-height:1.7}
    .ck-content h2{font-size:1.5em;margin-top:1.2em}.ck-content h3{font-size:1.25em}
    @media(max-width:1199.98px){.af-grid{grid-template-columns:1fr}.af-side{position:static}}
</style>
@endpush

<div class="af-grid">
    <div class="d-grid gap-3">
        <div class="admin-card p-3 p-md-4">
            <label class="form-label" for="title">Titre de l'article<span class="af-req">*</span> <span class="af-count" data-count-for="title" data-max="70"></span></label>
            <input type="text" id="title" name="title" class="form-control af-title-input @error('title') is-invalid @enderror" value="{{ old('title', $isEdit ? $article->title : null) }}" required maxlength="255" placeholder="Ex : Comment choisir son matelas à Abidjan">
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <div class="af-slug">Adresse : {{ url('/blog') }}/<b id="af-slug">{{ $isEdit ? $article->slug : '…' }}</b>@if($isEdit) <span class="ms-1">(conservée lors des modifications)</span>@endif</div>

            <label class="form-label mt-4" for="excerpt">Chapeau / résumé <span class="af-count" data-count-for="excerpt" data-max="160"></span></label>
            <textarea id="excerpt" name="excerpt" rows="2" class="form-control @error('excerpt') is-invalid @enderror" placeholder="1 à 2 phrases : affiché sous le titre, dans la liste du blog et sur Google.">{{ old('excerpt', $isEdit ? $article->excerpt : null) }}</textarea>
            @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="admin-card p-3 p-md-4">
            <label class="form-label" for="content">Contenu de l'article</label>
            <textarea id="content" name="content" rows="20" class="form-control">{{ old('content', $isEdit ? $article->content : null) }}</textarea>
            @error('content')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            <div class="af-stats"><span id="af-words">0 mot</span><span id="af-read">1 min de lecture</span><span>Astuce : structurez avec des intertitres « Titre 2 », glissez-déposez vos images dans le texte.</span></div>
        </div>
    </div>

    <aside class="af-side">
        <div class="admin-card p-3">
            <div class="fw-semibold mb-2">Publication</div>
            <div class="af-status" role="radiogroup" aria-label="Statut">
                <label><input type="radio" name="status" value="draft" @checked($status === 'draft')><span>Brouillon</span></label>
                <label><input type="radio" name="status" value="published" @checked($status === 'published')><span>En ligne</span></label>
            </div>
            @if($isEdit && $article->published_at)
                <div class="af-hint">Publié le {{ $article->published_at->format('d/m/Y à H:i') }}</div>
            @endif
            <div class="form-check mt-3">
                <input type="checkbox" id="is_featured" name="is_featured" class="form-check-input" value="1" @checked(old('is_featured', $isEdit ? $article->is_featured : false))>
                <label for="is_featured" class="form-check-label">À la une du blog</label>
            </div>
            <div class="form-check">
                <input type="checkbox" id="is_slider" name="is_slider" class="form-check-input" value="1" @checked(old('is_slider', $isEdit ? $article->is_slider : false))>
                <label for="is_slider" class="form-check-label">Afficher dans le slider</label>
            </div>
            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-admin-primary" data-af-submit>{{ $isEdit ? 'Enregistrer' : 'Créer l\'article' }}</button>
                @if($isEdit && $article->published_at)
                    <a class="btn btn-admin-ghost" href="{{ route('blog.show', $article->slug) }}" target="_blank" rel="noopener">Voir l'article ↗</a>
                @endif
                <a class="btn btn-admin-ghost" href="{{ route('admin.articles.index') }}">Annuler</a>
            </div>
        </div>

        <div class="admin-card p-3">
            <div class="fw-semibold mb-2">Image de couverture{!! $isEdit ? '' : '<span class="af-req">*</span>' !!}</div>
            <label class="af-drop" id="af-drop">
                @if($imageUrl && ! $imageMissing)<img src="{{ $imageUrl }}" alt="" id="af-preview">@else<img src="" alt="" id="af-preview" hidden>@endif
                <span id="af-drop-text">@if($imageMissing)<b class="text-warning">Image absente du serveur</b><br>@endif Cliquez ou déposez une image<br><small>1200 × 900 px conseillé · 4 Mo max</small></span>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" @if(! $isEdit) required @endif>
            </label>
            @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="admin-card p-3">
            <label class="form-label fw-semibold" for="category_id">Catégorie</label>
            <select id="category_id" name="category_id" class="form-select">
                <option value="">— Aucune —</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) old('category_id', $isEdit ? $article->blog_category_id : '') === (string) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
    </aside>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/translations/fr.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('content').form;
    const uploadUrl = @json(route('admin.articles.upload-image'));
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';

    // Envoi des images glissées dans le texte vers le serveur (optimisées en WebP).
    class UploadAdapter {
        constructor(loader) { this.loader = loader; }
        upload() {
            return this.loader.file.then(file => {
                const data = new FormData();
                data.append('upload', file);
                return fetch(uploadUrl, { method: 'POST', body: data, headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, credentials: 'same-origin' })
                    .then(r => r.ok ? r.json() : Promise.reject('Envoi de l’image impossible (4 Mo max).'))
                    .then(json => ({ default: json.url }));
            });
        }
        abort() {}
    }

    const words = document.getElementById('af-words');
    const read = document.getElementById('af-read');
    const stats = (html) => {
        const text = (html || '').replace(/<[^>]+>/g, ' ').trim();
        const n = text ? text.split(/\s+/).length : 0;
        if (words) words.textContent = n + (n > 1 ? ' mots' : ' mot');
        if (read) read.textContent = Math.max(1, Math.ceil(n / 200)) + ' min de lecture';
    };

    let dirty = false;
    if (window.ClassicEditor) {
        ClassicEditor.create(document.getElementById('content'), {
            language: 'fr',
            toolbar: ['heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', 'blockQuote', '|', 'uploadImage', 'insertTable', 'mediaEmbed', '|', 'undo', 'redo'],
            heading: { options: [
                { model: 'paragraph', title: 'Paragraphe', class: 'ck-heading_paragraph' },
                { model: 'heading2', view: 'h2', title: 'Titre 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Titre 3', class: 'ck-heading_heading3' },
            ] },
            image: { toolbar: ['imageTextAlternative', '|', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side'] },
            link: { addTargetToExternalLinks: true },
        }).then(editor => {
            editor.plugins.get('FileRepository').createUploadAdapter = loader => new UploadAdapter(loader);
            stats(editor.getData());
            editor.model.document.on('change:data', () => { dirty = true; stats(editor.getData()); });
            form.addEventListener('submit', () => editor.updateSourceElement());
        }).catch(() => {});
    } else {
        stats(document.getElementById('content').value);
    }

    // Compteurs
    document.querySelectorAll('[data-count-for]').forEach(c => {
        const f = document.getElementById(c.dataset.countFor), max = +c.dataset.max;
        const u = () => { const n = f.value.trim().length; c.textContent = n + ' / ' + max; c.classList.toggle('is-bad', n > max); };
        f.addEventListener('input', u); u();
    });

    // Aperçu de l'adresse (création uniquement)
    const slug = document.getElementById('af-slug');
    const title = document.getElementById('title');
    @if(! $isEdit)
    const slugify = s => s.normalize('NFD').replace(/[̀-ͯ]/g, '').toLowerCase().replace(/['’]/g, '').replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    title.addEventListener('input', () => { slug.textContent = slugify(title.value) || '…'; });
    @endif

    // Image : aperçu + glisser-déposer
    const drop = document.getElementById('af-drop'), input = document.getElementById('image'), preview = document.getElementById('af-preview'), text = document.getElementById('af-drop-text');
    const show = file => { if (!file || !file.type.startsWith('image/')) return; preview.src = URL.createObjectURL(file); preview.hidden = false; text.hidden = true; };
    input.addEventListener('change', () => show(input.files[0]));
    ['dragenter', 'dragover'].forEach(e => drop.addEventListener(e, ev => { ev.preventDefault(); drop.classList.add('is-over'); }));
    ['dragleave', 'drop'].forEach(e => drop.addEventListener(e, () => drop.classList.remove('is-over')));
    drop.addEventListener('drop', ev => { ev.preventDefault(); if (ev.dataTransfer.files.length) { input.files = ev.dataTransfer.files; show(input.files[0]); dirty = true; } });

    // Modifications non enregistrées / double envoi
    form.addEventListener('input', () => { dirty = true; });
    window.addEventListener('beforeunload', e => { if (dirty) { e.preventDefault(); e.returnValue = ''; } });
    form.addEventListener('submit', () => { dirty = false; form.querySelectorAll('[data-af-submit]').forEach(b => { b.disabled = true; b.textContent = 'Enregistrement…'; }); });
});
</script>
@endpush
