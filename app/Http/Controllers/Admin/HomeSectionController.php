<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeSectionController extends Controller
{
    public function index()
    {
        $this->ensureDefaultHomeSections();
        $sections = Section::query()->ordered()->get();

        return view('admin.home_sections.index', compact('sections'));
    }

    public function edit(Section $home_section)
    {
        $this->ensureDefaultHomeSections();
        $categories = Category::query()->ordered()->get();

        return view('admin.home_sections.edit', [
            'section' => $home_section,
            'categories' => $categories,
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
    }
}
