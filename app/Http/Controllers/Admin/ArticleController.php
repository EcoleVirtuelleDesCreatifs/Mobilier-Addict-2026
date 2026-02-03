<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = BlogPost::query()
            ->with(['category', 'user'])
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.articles.index', [
            'articles' => $articles,
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
        $article->slug = Str::slug($data['title']);
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
            $article->image = $request->file('image')->store('articles', 'public');
        }

        if (Schema::hasColumn('blog_posts', 'user_id')) {
            $article->user_id = $request->user()->id;
        }

        if (Schema::hasColumn('blog_posts', 'is_slider')) {
            $article->is_slider = (bool) ($data['is_slider'] ?? false);
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article créé avec succès.');
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
        $article->slug = Str::slug($data['title']);
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
            $article->image = $request->file('image')->store('articles', 'public');
        }

        if (Schema::hasColumn('blog_posts', 'is_slider')) {
            $article->is_slider = (bool) ($data['is_slider'] ?? false);
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article mis à jour avec succès.');
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

        $path = $request->file('upload')->store('articles', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}
