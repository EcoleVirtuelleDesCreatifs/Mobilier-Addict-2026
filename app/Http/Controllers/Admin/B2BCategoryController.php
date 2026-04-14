<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\B2BCategory;
use Illuminate\Http\Request;

class B2BCategoryController extends Controller
{
    public function index()
    {
        $categories = B2BCategory::query()->orderBy('id')->get();
        return view('admin.b2b.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.b2b.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:b2b_categories,key',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'color' => 'required|string|max:7',
            'is_active' => 'boolean',
            'min_products' => 'required|integer|min:1',
        ]);

        B2BCategory::query()->create($validated);

        return redirect()->route('admin.b2b.index')
            ->with('success', 'Catégorie B2B créée avec succès.');
    }

    public function edit(B2BCategory $b2bCategory)
    {
        return view('admin.b2b.edit', compact('b2bCategory'));
    }

    public function update(Request $request, B2BCategory $b2bCategory)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:b2b_categories,key,' . $b2bCategory->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'color' => 'required|string|max:7',
            'is_active' => 'boolean',
            'min_products' => 'required|integer|min:1',
        ]);

        $b2bCategory->update($validated);

        return redirect()->route('admin.b2b.index')
            ->with('success', 'Catégorie B2B mise à jour avec succès.');
    }

    public function destroy(B2BCategory $b2bCategory)
    {
        $b2bCategory->delete();

        return redirect()->route('admin.b2b.index')
            ->with('success', 'Catégorie B2B supprimée avec succès.');
    }
}
