<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::query()
            ->whereNull('parent_id')
            ->with(['children' => function ($query) {
                $query->orderBy('order');
            }])
            ->orderBy('position')
            ->orderBy('order')
            ->paginate(50);

        return view('admin.articles.menus', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::query()->whereNull('parent_id')->orderBy('position')->orderBy('order')->get();
        $products = Product::query()->orderBy('name')->get();

        return view('admin.articles.menus-create', compact('parentMenus', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:menus,slug'],
            'url' => ['nullable', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:menus,id'],
            'position' => ['required', 'in:header,footer,sidebar'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'open_new_tab' => ['nullable', 'boolean'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['integer', 'exists:products,id'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['open_new_tab'] = (bool) ($data['open_new_tab'] ?? false);

        if (!array_key_exists('order', $data) || $data['order'] === null) {
            $maxOrder = (int) (Menu::query()
                ->where('position', $data['position'])
                ->where('parent_id', $data['parent_id'] ?? null)
                ->max('order') ?? 0);
            $data['order'] = $maxOrder + 1;
        }

        $menu = Menu::query()->create($data);

        $productIds = $request->input('product_ids', []);
        $menu->products()->sync(is_array($productIds) ? $productIds : []);

        return redirect()->route('admin.menus.index')->with('success', 'Menu créé.');
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::query()
            ->whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->orderBy('position')
            ->orderBy('order')
            ->get();

        $products = Product::query()->orderBy('name')->get();
        $selectedProductIds = $menu->products()->pluck('products.id')->map(fn ($v) => (int) $v)->values()->all();

        return view('admin.articles.menus-edit', compact('menu', 'parentMenus', 'products', 'selectedProductIds'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:menus,slug,' . $menu->id],
            'url' => ['nullable', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:menus,id'],
            'position' => ['required', 'in:header,footer,sidebar'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'open_new_tab' => ['nullable', 'boolean'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['integer', 'exists:products,id'],
        ]);

        if (($data['parent_id'] ?? null) === $menu->id) {
            return back()->with('error', 'Le menu ne peut pas être son propre parent.')->withInput();
        }

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['open_new_tab'] = (bool) ($data['open_new_tab'] ?? false);
        $data['order'] = $data['order'] ?? 0;

        $menu->update($data);

        $productIds = $request->input('product_ids', []);
        $menu->products()->sync(is_array($productIds) ? $productIds : []);

        return redirect()->route('admin.menus.index')->with('success', 'Menu mis à jour.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->children()->exists()) {
            return back()->with('error', 'Impossible de supprimer : ce menu contient des sous-menus.');
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu supprimé.');
    }
}
