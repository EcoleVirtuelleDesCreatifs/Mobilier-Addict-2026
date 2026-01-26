<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $featured = BlogPost::query()
            ->active()
            ->featured()
            ->ordered()
            ->with(['category'])
            ->first();

        $posts = BlogPost::query()
            ->active()
            ->when($featured, fn ($q) => $q->where('id', '!=', $featured->id))
            ->ordered()
            ->with(['category'])
            ->paginate(12)
            ->withQueryString();

        return view('blog.index', compact('featured', 'posts'));
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
