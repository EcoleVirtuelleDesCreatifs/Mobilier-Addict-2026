<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with(['category', 'menus']);

        if ($search = $request->string('q')->trim()->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        $products = $query
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $productsTotalCount = Product::query()->count();
        $productsOnlineCount = Product::query()->where('is_active', true)->count();
        $productsOfflineCount = Product::query()->where('is_active', false)->count();

        $bestSellingProduct = null;
        if (Schema::hasTable('order_items')) {
            $row = DB::table('order_items')
                ->selectRaw('product_id, SUM(quantity) as qty')
                ->whereNotNull('product_id')
                ->groupBy('product_id')
                ->orderByDesc('qty')
                ->first();

            if ($row && !empty($row->product_id)) {
                $product = Product::query()->select(['id', 'name', 'slug'])->find($row->product_id);
                if ($product) {
                    $bestSellingProduct = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'qty' => (int) ($row->qty ?? 0),
                    ];
                }
            }
        }

        return view('admin.products.index', compact(
            'products',
            'productsTotalCount',
            'productsOnlineCount',
            'productsOfflineCount',
            'bestSellingProduct',
        ));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();
        $menus = Menu::query()
            ->orderBy('position')
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        return view('admin.products.create', compact('categories', 'menus'));
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);
        $data = $this->normalizeProductData($data);
        $data = $this->handleProductUploads($request, $data);

        $product = DB::transaction(function () use ($data, $request) {
            $product = Product::create($data);
            $this->syncVariants($request, $product);

            return $product;
        });

        $menuIds = $request->input('menu_ids', []);
        $menuIds = is_array($menuIds) ? $menuIds : [];

        if (!empty($menuIds) && !Schema::hasTable('menu_product')) {
            throw ValidationException::withMessages([
                'menu_ids' => "La table pivot 'menu_product' n'existe pas encore en base. Lancez la migration pour activer le rattachement produit → menus.",
            ]);
        }

        if (Schema::hasTable('menu_product')) {
            $product->menus()->sync($menuIds);
        }

        return redirect()->route('admin.products.index')->with('status', 'Produit créé avec succès.');
    }

    public function edit(Product $product)
    {
        $product->load(['variants' => fn($q) => $q->orderBy('thickness_cm')->orderBy('places')]);
        $categories = Category::query()->orderBy('name')->get();
        $menus = Menu::query()
            ->orderBy('position')
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        $selectedMenuIds = $product->menus()->pluck('menus.id')->all();

        return view('admin.products.edit', compact('product', 'categories', 'menus', 'selectedMenuIds'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request, $product);
        $data = $this->normalizeProductData($data);
        $data = $this->handleProductUploads($request, $data, $product);

        DB::transaction(function () use ($data, $request, $product) {
            $product->update($data);
            $this->syncVariants($request, $product);
        });

        $menuIds = $request->input('menu_ids', []);
        $menuIds = is_array($menuIds) ? $menuIds : [];

        if (!empty($menuIds) && !Schema::hasTable('menu_product')) {
            throw ValidationException::withMessages([
                'menu_ids' => "La table pivot 'menu_product' n'existe pas encore en base. Lancez la migration pour activer le rattachement produit → menus.",
            ]);
        }

        if (Schema::hasTable('menu_product')) {
            $product->menus()->sync($menuIds);
        }

        return redirect()->route('admin.products.index')->with('status', 'Produit mis à jour.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Produit supprimé.');
    }

    public function toggleActive(Product $product)
    {
        $product->update([
            'is_active' => !$product->is_active,
        ]);

        return redirect()->back()->with('status', $product->is_active ? 'Produit activé (en ligne).' : 'Produit désactivé (hors ligne).');
    }

    public function destroyImage(Product $product)
    {
        $path = (string) ($product->image ?? '');
        $this->deletePublicUploadIfLocal($path);

        $product->update([
            'image' => null,
        ]);

        return redirect()->back()->with('status', "Image principale supprimée.");
    }

    public function destroyGalleryImage(Product $product, $index)
    {
        $gallery = $product->gallery ?: [];
        $gallery = is_array($gallery) ? $gallery : [];

        $i = is_numeric($index) ? (int) $index : -1;
        if (!array_key_exists($i, $gallery)) {
            return redirect()->back()->with('status', "Image introuvable.");
        }

        $path = (string) ($gallery[$i] ?? '');
        $this->deletePublicUploadIfLocal($path);

        unset($gallery[$i]);
        $gallery = array_values($gallery);

        $product->update([
            'gallery' => !empty($gallery) ? $gallery : null,
        ]);

        return redirect()->back()->with('status', "Image de la galerie supprimée.");
    }

    private function deletePublicUploadIfLocal(string $path): void
    {
        $path = trim($path);
        if ($path === '') {
            return;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return;
        }

        $normalized = ltrim($path, '/');
        if (!Str::startsWith($normalized, 'uploads/')) {
            return;
        }

        $fullPath = public_path($normalized);
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }

    private function storeUploadedImage($file, string $folder): string
    {
        $dir = public_path('uploads/' . $folder);

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return 'uploads/' . $folder . '/' . $filename;
    }

    private function validateProduct(Request $request, ?Product $product = null): array
    {
        $isUpdate = $product !== null;

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug' . ($isUpdate ? ',' . $product->id : '')],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'seo_keywords' => ['nullable', 'string', 'max:255'],
            'image' => [$isUpdate ? 'nullable' : 'required', 'image', 'max:4096'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['nullable', 'image', 'max:4096'],
            'price' => ['required', 'numeric', 'min:0'],
            'shipping_price' => ['nullable', 'numeric', 'min:0'],
            'promo_price' => ['nullable', 'numeric', 'min:0'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'discount_percent' => ['nullable', 'integer', 'min:0', 'max:100'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'badge' => ['nullable', 'string', 'max:50'],
            'badge_type' => ['nullable', 'in:new,hot,sale,custom'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'sku' => ['nullable', 'string', 'max:255', 'unique:products,sku' . ($isUpdate ? ',' . $product->id : '')],
            'dimensions' => ['nullable', 'string', 'max:255'],
            'material' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'is_bestseller' => ['nullable', 'boolean'],
            'is_collection' => ['nullable', 'boolean'],
            'section' => ['nullable', 'in:collection,featured,bestseller'],
            'sections' => ['nullable', 'array'],
            'sections.*' => ['in:collection,featured,bestseller'],
            'is_active' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'menu_ids' => ['nullable', 'array'],
            'menu_ids.*' => ['integer', 'exists:menus,id'],

            'variants_enabled' => ['nullable', 'boolean'],

            'variants' => ['nullable', 'array'],
            'variants.*.id' => ['nullable', 'integer', 'exists:product_variants,id'],
            'variants.*.variant_type' => ['nullable', 'string', 'max:100'],
            'variants.*.thickness_cm' => ['nullable', 'integer', 'min:0', 'max:200'],
            'variants.*.places' => ['required_with:variants.*.price', 'integer', 'min:1', 'max:10'],
            'variants.*.price' => ['required_with:variants.*.places', 'numeric', 'min:0'],
            'variants.*.stock' => ['nullable', 'integer', 'min:0'],
            'variants.*.is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function syncVariants(Request $request, Product $product): void
    {
        if (!$request->has('variants_enabled')) {
            return;
        }

        $hasVariantTypeColumn = Schema::hasColumn('product_variants', 'variant_type');

        $rows = $request->input('variants', []);
        $rows = is_array($rows) ? $rows : [];

        if (empty($rows)) {
            ProductVariant::query()
                ->where('product_id', $product->id)
                ->delete();
            return;
        }

        $keptIds = [];
        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $variantType = isset($row['variant_type']) ? trim((string) $row['variant_type']) : '';
            $variantType = $variantType !== '' ? $variantType : null;

            $thickness = isset($row['thickness_cm']) ? (int) $row['thickness_cm'] : 0;
            $places = isset($row['places']) ? (int) $row['places'] : null;
            $price = isset($row['price']) ? (float) $row['price'] : null;

            if ((!$variantType && $thickness <= 0) || !$places || $price === null) {
                continue;
            }

            $variantId = isset($row['id']) && $row['id'] !== '' ? (int) $row['id'] : null;
            $stock = isset($row['stock']) ? (int) $row['stock'] : 0;
            $isActive = (bool) ($row['is_active'] ?? true);

            $variant = null;
            if ($variantId) {
                $variant = ProductVariant::query()
                    ->where('id', $variantId)
                    ->where('product_id', $product->id)
                    ->first();
            }

            if ($variant) {
                $payload = [
                    'thickness_cm' => $thickness,
                    'places' => $places,
                    'price' => $price,
                    'stock' => $stock,
                    'is_active' => $isActive,
                ];
                if ($hasVariantTypeColumn) {
                    $payload['variant_type'] = $variantType;
                }
                $variant->update($payload);
                $keptIds[] = (int) $variant->id;
            } else {
                $identity = [
                    'product_id' => $product->id,
                    'thickness_cm' => $thickness,
                    'places' => $places,
                ];
                if ($hasVariantTypeColumn) {
                    $identity['variant_type'] = $variantType;
                }

                $created = ProductVariant::updateOrCreate(
                    $identity,
                    [
                        'price' => $price,
                        'stock' => $stock,
                        'is_active' => $isActive,
                    ]
                );
                $keptIds[] = (int) $created->id;
            }
        }

        $keep = array_values(array_unique(array_filter($keptIds)));
        if (!empty($keep)) {
            ProductVariant::query()
                ->where('product_id', $product->id)
                ->whereNotIn('id', $keep)
                ->delete();
        }
    }

    private function normalizeProductData(array $data): array
    {
        if (!Schema::hasColumn('products', 'seo_title')) {
            unset($data['seo_title']);
        }
        if (!Schema::hasColumn('products', 'seo_description')) {
            unset($data['seo_description']);
        }
        if (!Schema::hasColumn('products', 'seo_keywords')) {
            unset($data['seo_keywords']);
        }

        if (!Schema::hasColumn('products', 'shipping_price')) {
            if (!empty($data['shipping_price']) && (float) $data['shipping_price'] > 0) {
                throw ValidationException::withMessages([
                    'shipping_price' => "La colonne 'shipping_price' n'existe pas encore en base. Lancez la migration pour activer le prix de livraison.",
                ]);
            }
            unset($data['shipping_price']);
        } else {
            $data['shipping_price'] = $data['shipping_price'] ?? 0;
        }

        if (!empty($data['promo_price'])) {
            $currentPrice = (float) $data['price'];
            $promoPrice = (float) $data['promo_price'];

            if ($promoPrice > 0 && $promoPrice < $currentPrice) {
                $data['old_price'] = ($data['old_price'] ?? null) ?: $data['price'];
                $data['price'] = $data['promo_price'];
            }
        }
        unset($data['promo_price']);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['stock'] = $data['stock'] ?? 0;
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['is_bestseller'] = (bool) ($data['is_bestseller'] ?? false);
        $data['is_collection'] = (bool) ($data['is_collection'] ?? false);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['order'] = $data['order'] ?? 0;

        if (!empty($data['sections']) && is_array($data['sections'])) {
            $sections = array_values(array_unique(array_filter($data['sections'], fn($v) => is_string($v) && $v !== '')));
            $data['is_collection'] = in_array('collection', $sections, true);
            $data['is_featured'] = in_array('featured', $sections, true);
            $data['is_bestseller'] = in_array('bestseller', $sections, true);
        }
        unset($data['sections']);

        if (!empty($data['section'])) {
            if ($data['section'] === 'collection') {
                $data['is_collection'] = true;
            }
            if ($data['section'] === 'featured') {
                $data['is_featured'] = true;
            }
            if ($data['section'] === 'bestseller') {
                $data['is_bestseller'] = true;
            }
        }
        unset($data['section']);

        if (!empty($data['old_price']) && (float) $data['old_price'] > 0 && empty($data['discount_percent'])) {
            $price = (float) $data['price'];
            $oldPrice = (float) $data['old_price'];
            if ($oldPrice > $price && $price >= 0) {
                $data['discount_percent'] = (int) round((($oldPrice - $price) / $oldPrice) * 100);
            }
        }

        return $data;
    }

    private function handleProductUploads(Request $request, array $data, ?Product $product = null): array
    {
        if ($request->hasFile('image')) {
            $data['image'] = $this->storeUploadedImage($request->file('image'), 'products');
        }

        if (!$product && empty($data['image'])) {
            $data['image'] = $this->storeUploadedImage($request->file('image'), 'products');
        }

        $gallery = $product?->gallery ?: [];
        if ($request->hasFile('gallery')) {
            foreach ((array) $request->file('gallery') as $file) {
                if ($file) {
                    $gallery[] = $this->storeUploadedImage($file, 'products');
                }
            }
        }
        $data['gallery'] = $gallery ?: null;

        return $data;
    }
}
