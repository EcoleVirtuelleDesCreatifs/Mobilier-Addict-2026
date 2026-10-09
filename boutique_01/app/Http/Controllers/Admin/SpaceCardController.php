<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpaceCard;
use App\Models\SpaceSection;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;

class SpaceCardController extends Controller
{
    public function store(Request $request, SpaceSection $space_section)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image', 'max:4096'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'size' => ['required', 'in:small,large'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['space_section_id'] = $space_section->id;
        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $file = $request->file('image');
        $data['image'] = ImageOptimizer::storePublicUpload($file, 'uploads/spaces', 1400, 80);

        SpaceCard::create($data);

        return redirect()->route('admin.space_sections.edit', $space_section)->with('status', 'Carte ajoutée.');
    }

    public function update(Request $request, SpaceSection $space_section, SpaceCard $space_card)
    {
        if ((int) $space_card->space_section_id !== (int) $space_section->id) {
            abort(404);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'size' => ['required', 'in:small,large'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = ImageOptimizer::storePublicUpload($file, 'uploads/spaces', 1400, 80);
        }

        $space_card->update($data);

        return redirect()->route('admin.space_sections.edit', $space_section)->with('status', 'Carte mise à jour.');
    }

    public function destroy(SpaceSection $space_section, SpaceCard $space_card)
    {
        if ((int) $space_card->space_section_id !== (int) $space_section->id) {
            abort(404);
        }

        $space_card->delete();

        return redirect()->route('admin.space_sections.edit', $space_section)->with('status', 'Carte supprimée.');
    }
}
