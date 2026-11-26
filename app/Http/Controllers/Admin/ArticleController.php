<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');

        $articles = BlogPost::query()
            ->with(['category', 'user'])
            ->when($search !== '', fn ($q) => $q->where('title', 'like', '%' . $search . '%'))
            ->when($status === 'published', fn ($q) => $q->whereNotNull('published_at')->where('is_active', true))
            ->when($status === 'draft', fn ($q) => $q->where(fn ($qq) => $qq->whereNull('published_at')->orWhere('is_active', false)))
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $all = BlogPost::query()->get(['id', 'image', 'published_at', 'is_active']);
        $counts = [
            'all' => $all->count(),
            'published' => $all->filter(fn ($p) => $p->published_at && $p->is_active)->count(),
            'draft' => $all->reject(fn ($p) => $p->published_at && $p->is_active)->count(),
            'no_image' => $all->filter(fn ($p) => ! $p->image || str_contains(image_url($p->image), 'product-placeholder'))->count(),
        ];

        return view('admin.articles.index', [
            'articles' => $articles,
            'counts' => $counts,
        ]);
    }

    public function create()
    {
        $categories = BlogCategory::query()->orderBy('name')->get();

        return view('admin.articles.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'image' => ['required', 'image', 'max:4096'],
            'category_id' => ['nullable', 'integer', 'exists:blog_categories,id'],
            'status' => ['nullable', 'in:draft,published'],
            'is_featured' => ['nullable', 'boolean'],
            'is_slider' => ['nullable', 'boolean'],
        ]);

        $article = new BlogPost();
        $article->title = $data['title'];
        $article->slug = $this->uniqueSlug($data['title']);
        $article->excerpt = $data['excerpt'] ?? null;
        $article->content = $data['content'] ?? null;
        $article->blog_category_id = $data['category_id'] ?? null;

        $article->is_featured = (bool) ($data['is_featured'] ?? false);

        $status = $data['status'] ?? 'draft';
        if ($status === 'published') {
            $article->published_at = now();
            $article->is_active = true;
        } else {
            $article->published_at = null;
            $article->is_active = false;
        }

        if ($request->hasFile('image')) {
            $article->image = ImageOptimizer::storeStoragePublic($request->file('image'), 'articles', 1200, 80);
        }

        if (Schema::hasColumn('blog_posts', 'user_id')) {
            $article->user_id = $request->user()->id;
        }

        if (Schema::hasColumn('blog_posts', 'is_slider')) {
            $article->is_slider = (bool) ($data['is_slider'] ?? false);
        }

        $article->reading_time = $this->readingTime($article->content);
        $article->save();

        return redirect()->route('admin.articles.edit', $article)->with('success', 'Article créé avec succès.');
    }

    public function edit(BlogPost $article)
    {
        $categories = BlogCategory::query()->orderBy('name')->get();

        return view('admin.articles.edit', [
            'article' => $article,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, BlogPost $article)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'category_id' => ['nullable', 'integer', 'exists:blog_categories,id'],
            'status' => ['nullable', 'in:draft,published'],
            'is_featured' => ['nullable', 'boolean'],
            'is_slider' => ['nullable', 'boolean'],
        ]);

        $article->title = $data['title'];
        // L'adresse d'un article existant ne change pas quand on retouche son titre (liens et SEO conservés).
        $article->slug = $article->slug ?: $this->uniqueSlug($data['title'], $article->id);
        $article->excerpt = $data['excerpt'] ?? null;
        $article->content = $data['content'] ?? null;
        $article->blog_category_id = $data['category_id'] ?? null;
        $article->is_featured = (bool) ($data['is_featured'] ?? false);

        $status = $data['status'] ?? 'draft';
        if ($status === 'published') {
            $article->published_at = $article->published_at ?: now();
            $article->is_active = true;
        } else {
            $article->published_at = null;
            $article->is_active = false;
        }

        if ($request->hasFile('image')) {
            $article->image = ImageOptimizer::storeStoragePublic($request->file('image'), 'articles', 1200, 80);
        }

        if (Schema::hasColumn('blog_posts', 'is_slider')) {
            $article->is_slider = (bool) ($data['is_slider'] ?? false);
        }

        $article->reading_time = $this->readingTime($article->content);
        $article->save();

        return redirect()->route('admin.articles.edit', $article)->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(BlogPost $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé avec succès.');
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => ['required', 'image', 'max:4096'],
        ]);

        $path = ImageOptimizer::storeStoragePublic($request->file('upload'), 'articles', 1600, 80);

        return response()->json([
            'url' => image_url($path),
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'article';
        $slug = $base;
        $i = 2;
        while (BlogPost::query()->where('slug', $slug)->when($ignoreId, fn ($q) => $q->whereKeyNot($ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    private function readingTime(?string $content): int
    {
        return max(1, (int) ceil(str_word_count(strip_tags((string) $content)) / 200));
    }
}
