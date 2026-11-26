<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $categorySlug = trim((string) request()->query('category', ''));

        $blogCategories = BlogCategory::query()
            ->whereHas('posts', fn ($q) => $q->active())
            ->withCount(['posts' => fn ($q) => $q->active()])
            ->orderBy('name')
            ->get();

        $activeCategory = $categorySlug !== ''
            ? $blogCategories->firstWhere('slug', $categorySlug)
            : null;

        $blogFeaturedPost = BlogPost::query()
            ->active()
            ->featured()
            ->ordered()
            ->with(['category'])
            ->when($activeCategory, fn ($q) => $q->where('blog_category_id', $activeCategory->id))
            ->first();

        // Aucun article « à la une » : le plus récent prend la place (page 1 uniquement).
        if (! $blogFeaturedPost && (int) request()->query('page', 1) <= 1) {
            $blogFeaturedPost = BlogPost::query()
                ->active()
                ->with(['category'])
                ->when($activeCategory, fn ($q) => $q->where('blog_category_id', $activeCategory->id))
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->first();
        }

        $blogPosts = BlogPost::query()
            ->active()
            ->when($blogFeaturedPost, fn ($q) => $q->where('id', '!=', $blogFeaturedPost->id))
            ->when($activeCategory, fn ($q) => $q->where('blog_category_id', $activeCategory->id))
            ->ordered()
            ->with(['category'])
            ->paginate(9)
            ->withQueryString();

        foreach (collect([$blogFeaturedPost])->filter()->merge($blogPosts->items()) as $post) {
            $post->reading_time = $post->reading_time ?: max(1, (int) ceil(str_word_count(strip_tags((string) $post->content)) / 200));
        }

        return view('blog.index', compact('blogFeaturedPost', 'blogPosts', 'blogCategories', 'activeCategory'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::query()
            ->active()
            ->with(['category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPosts = BlogPost::query()
            ->active()
            ->when($post->blog_category_id, fn ($q) => $q->where('blog_category_id', $post->blog_category_id))
            ->where('id', '!=', $post->id)
            ->ordered()
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
