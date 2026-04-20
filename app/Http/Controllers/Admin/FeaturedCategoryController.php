<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedCategory;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;

class FeaturedCategoryController extends Controller
{
    public function index()
    {
        $featuredCategories = FeaturedCategory::query()->ordered()->get();
        return view('admin.featured_categories.index', compact('featuredCategories'));
    }

    public function create()
    {
        return view('admin.featured_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'menu_slug' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'cta' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = $data['is_active'] ?? true;
        $data['cta'] = $data['cta'] ?? 'Découvrir';

        if ($request->hasFile('image')) {
            $data['image'] = ImageOptimizer::storePublicUpload($request->file('image'), 'uploads/featured-categories', 1200, 80);
        }

        FeaturedCategory::create($data);

        return redirect()->route('admin.featured_categories.index')->with('status', 'Catégorie phare créée.');
    }

    public function edit(FeaturedCategory $featured_category)
    {
        return view('admin.featured_categories.edit', compact('featured_category'));
    }

    public function update(Request $request, FeaturedCategory $featured_category)
    {
        $data = $request->validate([
            'menu_slug' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'cta' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['order'] = $data['order'] ?? $featured_category->order;
        $data['is_active'] = $data['is_active'] ?? $featured_category->is_active;
        $data['cta'] = $data['cta'] ?? $featured_category->cta;

        if ($request->hasFile('image')) {
            if ($featured_category->image) {
                @unlink(public_path($featured_category->image));
            }
            $data['image'] = ImageOptimizer::storePublicUpload($request->file('image'), 'uploads/featured-categories', 1200, 80);
        }

        $featured_category->update($data);

        return redirect()->route('admin.featured_categories.edit', $featured_category)->with('status', 'Catégorie phare mise à jour.');
    }

    public function destroy(FeaturedCategory $featured_category)
    {
        if ($featured_category->image) {
            @unlink(public_path($featured_category->image));
        }
        $featured_category->delete();

        return redirect()->route('admin.featured_categories.index')->with('status', 'Catégorie phare supprimée.');
    }
}
