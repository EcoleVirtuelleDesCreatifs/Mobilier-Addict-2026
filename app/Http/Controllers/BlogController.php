<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $blogFeaturedPost = BlogPost::query()
            ->active()
            ->featured()
            ->ordered()
            ->with(['category'])
            ->first();

        $blogPosts = BlogPost::query()
            ->active()
            ->when($blogFeaturedPost, fn ($q) => $q->where('id', '!=', $blogFeaturedPost->id))
            ->ordered()
            ->with(['category'])
            ->paginate(12)
            ->withQueryString();

        return view('blog.index', compact('blogFeaturedPost', 'blogPosts'));
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
