<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('q')->trim()->toString();

        $menus = Menu::query()
            ->orderBy('position')
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        $categoriesByMenu = [];

        foreach ($menus as $menu) {
            $query = Category::query()
                ->with(['parent', 'section'])
                ->whereHas('menus', function ($q) use ($menu) {
                    $q->where('menus.id', $menu->id);
                });

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            }

            $categoriesByMenu[$menu->id] = $query
                ->orderBy('order')
                ->orderBy('name')
                ->get();
        }

        // Categories without menu
        $unassignedCategories = Category::query()
            ->with(['parent', 'section'])
            ->whereDoesntHave('menus')
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        return view('admin.categories.index', compact('menus', 'categoriesByMenu', 'unassignedCategories'));
    }

    public function create()
    {
        $parents = Category::query()->orderBy('name')->get();

        $menus = Menu::query()
            ->orderBy('position')
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        return view('admin.categories.create', compact('parents', 'menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image', 'max:4096'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'size' => ['nullable', 'in:small,medium,large'],
            'order' => ['nullable', 'integer'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'menu_ids' => ['nullable', 'array'],
            'menu_ids.*' => ['integer', 'exists:menus,id'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['integer', 'exists:products,id'],
        ]);

        $data['slug'] = $this->makeUniqueSlug($data['slug'] ?? Str::slug($data['name']));
        $data['size'] = $data['size'] ?? 'medium';
        $data['order'] = $data['order'] ?? 0;
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['is_active'] = (bool) ($data['is_active'] ?? true);
        $data['products_count'] = 0;

        $data['image'] = $this->storeUploadedImage($request->file('image'), 'categories');

        $category = Category::create($data);

        $menuIds = $request->input('menu_ids', []);
        $category->menus()->sync(is_array($menuIds) ? $menuIds : []);

        $productIds = $request->input('product_ids', []);
        $category->products()->sync(is_array($productIds) ? $productIds : []);

        return redirect()->route('admin.categories.index')->with('status', 'Catégorie créée avec succès.');
    }

    public function edit(Category $category)
    {
        $parents = Category::query()->whereKeyNot($category->id)->orderBy('name')->get();

        $menus = Menu::query()
            ->orderBy('position')
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        $selectedMenuIds = $category->menus()->pluck('menus.id')->map(fn ($v) => (int) $v)->values()->all();

        return view('admin.categories.edit', compact('category', 'parents', 'menus', 'selectedMenuIds'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug,' . $category->id],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'size' => ['nullable', 'in:small,medium,large'],
            'order' => ['nullable', 'integer'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'menu_ids' => ['nullable', 'array'],
            'menu_ids.*' => ['integer', 'exists:menus,id'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['integer', 'exists:products,id'],
        ]);

        $data['slug'] = $this->makeUniqueSlug($data['slug'] ?? Str::slug($data['name']), $category->id);
        $data['size'] = $data['size'] ?? $category->size ?? 'medium';
        $data['order'] = $data['order'] ?? $category->order ?? 0;
        $data['is_featured'] = (bool) ($data['is_featured'] ?? $category->is_featured ?? false);
        $data['is_active'] = (bool) ($data['is_active'] ?? $category->is_active ?? true);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeUploadedImage($request->file('image'), 'categories');
        }

        $category->update($data);

        $menuIds = $request->input('menu_ids', []);
        $category->menus()->sync(is_array($menuIds) ? $menuIds : []);

        $productIds = $request->input('product_ids', []);
        $category->products()->sync(is_array($productIds) ? $productIds : []);

        return redirect()->route('admin.categories.index')->with('status', 'Catégorie mise à jour.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Catégorie supprimée.');
    }

    private function storeUploadedImage($file, string $folder): string
    {
        return ImageOptimizer::storePublicUpload($file, 'uploads/' . $folder, 800, 80);
    }

    private function makeUniqueSlug(string $baseSlug, ?int $ignoreId = null): string
    {
        $baseSlug = trim($baseSlug);
        $baseSlug = $baseSlug !== '' ? $baseSlug : Str::random(8);

        $slug = $baseSlug;
        $i = 2;

        while (Category::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
