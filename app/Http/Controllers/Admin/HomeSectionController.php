<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Section;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeSectionController extends Controller
{
    public function index()
    {
        $this->ensureDefaultHomeSections();
        $sections = Section::query()
            ->withCount('categories')
            ->with(['categories:id,name,section_id,order'])
            ->ordered()
            ->get();

        return view('admin.home_sections.index', compact('sections'));
    }

    public function create()
    {
        $this->ensureDefaultHomeSections();
        $categories = Category::query()->ordered()->get();
        $nextOrder = (int) (Section::query()->max('order') ?? 0) + 1;

        return view('admin.home_sections.create', [
            'categories' => $categories,
            'nextOrder' => $nextOrder,
        ]);
    }

    public function store(Request $request)
    {
        $this->ensureDefaultHomeSections();

        $data = $request->validate([
            'badge' => ['nullable', 'string', 'max:255'],
            'badge_icon' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'background_color' => ['nullable', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'content' => ['nullable', 'string'],
            'type' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['integer', 'exists:categories,id'],
        ]);

        $data['slug'] = $this->makeUniqueSlug($data['slug'] ?: Str::slug($data['title']));
        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $categoryIds = collect($data['category_ids'] ?? [])->map(fn ($v) => (int) $v)->values();
        unset($data['category_ids']);

        if (array_key_exists('content', $data) && is_string($data['content']) && trim($data['content']) !== '') {
            $decoded = json_decode($data['content'], true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['content' => 'Le contenu doit être un JSON valide.'])->withInput();
            }
            $data['content'] = $decoded;
        } else {
            $data['content'] = null;
        }

        $section = Section::create($data);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $section->cover_image = ImageOptimizer::storePublicUpload($file, 'uploads/sections', 1600, 80);
            $section->save();
        }

        if ($categoryIds->isNotEmpty()) {
            Category::query()->whereIn('id', $categoryIds)->update(['section_id' => $section->id]);
        }

        return redirect()->route('admin.home_sections.edit', $section)->with('status', 'Section créée.');
    }

    public function edit(Section $home_section)
    {
        $this->ensureDefaultHomeSections();
        $categories = Category::query()->ordered()->get();

        $menus = null;
        if ($home_section->slug === 'explore-categories') {
            $menus = Menu::query()->active()->ordered()->get();
        }

        return view('admin.home_sections.edit', [
            'section' => $home_section,
            'categories' => $categories,
            'menus' => $menus,
        ]);
    }

    public function update(Request $request, Section $home_section)
    {
        $data = $request->validate([
            'badge' => ['nullable', 'string', 'max:255'],
            'badge_icon' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'background_color' => ['nullable', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'content' => ['nullable', 'string'],
            'type' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['integer', 'exists:categories,id'],
        ]);

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $categoryIds = collect($data['category_ids'] ?? [])->map(fn ($v) => (int) $v)->values();
        unset($data['category_ids']);

        if (array_key_exists('content', $data) && is_string($data['content']) && trim($data['content']) !== '') {
            $decoded = json_decode($data['content'], true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['content' => 'Le contenu doit être un JSON valide.'])->withInput();
            }
            $data['content'] = $decoded;
        } else {
            $data['content'] = null;
        }

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $data['cover_image'] = ImageOptimizer::storePublicUpload($file, 'uploads/sections', 1600, 80);
        }

        if ($home_section->slug === 'explore-categories') {
            $payload = $this->buildExploreCategoriesContentFromRequest($request, $home_section->content ?? []);
            $data['content'] = $payload;
        }

        $home_section->update($data);

        Category::query()
            ->where('section_id', $home_section->id)
            ->whereNotIn('id', $categoryIds)
            ->update(['section_id' => null]);

        if ($categoryIds->isNotEmpty()) {
            Category::query()->whereIn('id', $categoryIds)->update(['section_id' => $home_section->id]);
        }

        return redirect()->route('admin.home_sections.index')->with('status', 'Section mise à jour.');
    }

    private function buildExploreCategoriesContentFromRequest(Request $request, array $existing): array
    {
        $cards = [];

        for ($i = 0; $i < 6; $i++) {
            $menuSlug = trim((string) $request->input("explore_cards.$i.menu_slug", ''));
            $title = trim((string) $request->input("explore_cards.$i.title", ''));
            $cta = trim((string) $request->input("explore_cards.$i.cta", ''));

            if ($menuSlug === '' && $title === '' && !$request->hasFile("explore_cards.$i.image")) {
                continue;
            }

            $current = [];
            if (!empty($existing['cards']) && is_array($existing['cards'])) {
                $current = (array) ($existing['cards'][$i] ?? []);
            }

            $image = $current['image'] ?? null;
            if ($request->hasFile("explore_cards.$i.image")) {
                $file = $request->file("explore_cards.$i.image");
                $image = ImageOptimizer::storePublicUpload($file, 'uploads/categories', 1200, 82);
            }

            $cards[] = [
                'menu_slug' => $menuSlug !== '' ? $menuSlug : ($current['menu_slug'] ?? null),
                'title' => $title !== '' ? $title : ($current['title'] ?? ''),
                'cta' => $cta !== '' ? $cta : ($current['cta'] ?? 'Découvrir'),
                'image' => $image,
                'image_alt' => $title !== '' ? $title : (($current['image_alt'] ?? '') ?: ($current['title'] ?? '')),
            ];
        }

        return [
            'cards' => $cards,
        ];
    }

    private function ensureDefaultHomeSections(): void
    {
        Section::query()->firstOrCreate(
            ['slug' => 'categories'],
            [
                'badge' => 'Explorez nos univers',
                'badge_icon' => '🛒',
                'title' => 'Trouvez Votre Bonheur',
                'description' => null,
                'background_color' => null,
                'type' => 'categories',
                'order' => 1,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'electro'],
            [
                'badge' => 'Électroménager & Meubles',
                'badge_icon' => '🔌',
                'title' => 'Équipez Votre Maison',
                'description' => null,
                'background_color' => null,
                'type' => 'categories',
                'order' => 2,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'refuge'],
            [
                'badge' => 'Laissez-vous séduire',
                'badge_icon' => '✨',
                'title' => 'Créez Votre Refuge de Bien-Être',
                'description' => "Chaque nuit mérite d’être exceptionnelle. Découvrez nos univers pensés pour éveiller vos sens.",
                'background_color' => '#fde7f3',
                'type' => 'custom',
                'order' => 3,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'oreillers'],
            [
                'badge' => 'Oreillers',
                'badge_icon' => '🛏️',
                'title' => 'Oreillers',
                'description' => null,
                'background_color' => null,
                'type' => 'custom',
                'order' => 10,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'draps'],
            [
                'badge' => 'Draps',
                'badge_icon' => '🧺',
                'title' => 'Draps',
                'description' => null,
                'background_color' => null,
                'type' => 'custom',
                'order' => 11,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'essentiels'],
            [
                'badge' => 'Coup de Cœur',
                'badge_icon' => '❤️',
                'title' => 'Les Essentiels de Votre Bien-Être',
                'description' => 'Découvrez les produits adorés par notre communauté.',
                'background_color' => '#fde7f3',
                'type' => 'custom',
                'order' => 4,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'univers'],
            [
                'badge' => 'Solutions adaptées',
                'badge_icon' => '🧩',
                'title' => 'Sur-mesure',
                'description' => 'Que vous équipiez un hôtel, un appartement ou votre maison familiale, nous avons la solution parfaite.',
                'background_color' => 'linear-gradient(135deg, #4f46e5 0%, #ec4899 100%)',
                'type' => 'custom',
                'order' => 5,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'explore-categories'],
            [
                'badge' => null,
                'badge_icon' => null,
                'title' => 'Meilleures Catégories',
                'description' => 'Matelas, Oreillers, Couettes, Électroménagers, Lit et Canapé',
                'background_color' => null,
                'type' => 'custom',
                'order' => 6,
                'is_active' => true,
                'content' => [
                    'cards' => [
                        [
                            'menu_slug' => 'matelas',
                            'title' => 'Matelas',
                            'cta' => 'Découvrir',
                            'image' => null,
                            'image_alt' => 'Matelas',
                        ],
                        [
                            'menu_slug' => 'lit-canape',
                            'title' => 'Lits & Canapés',
                            'cta' => 'Découvrir',
                            'image' => null,
                            'image_alt' => 'Lits & Canapés',
                        ],
                        [
                            'menu_slug' => 'electromenager',
                            'title' => 'Electroménagers',
                            'cta' => 'Découvrir',
                            'image' => null,
                            'image_alt' => 'Electroménagers',
                        ],
                        [
                            'menu_slug' => 'drap-et-couettes',
                            'title' => 'Couettes',
                            'cta' => 'Découvrir',
                            'image' => null,
                            'image_alt' => 'Couettes',
                        ],
                    ],
                ],
            ]
        );
    }

    private function makeUniqueSlug(string $baseSlug): string
    {
        $baseSlug = trim($baseSlug);
        $baseSlug = $baseSlug !== '' ? $baseSlug : Str::random(8);

        $slug = $baseSlug;
        $i = 2;

        while (Section::query()->where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
