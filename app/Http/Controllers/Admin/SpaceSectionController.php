<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpaceSection;
use Illuminate\Http\Request;

class SpaceSectionController extends Controller
{
    public function index()
    {
        $sections = SpaceSection::query()->ordered()->withCount('cards')->get();

        return view('admin.space_sections.index', compact('sections'));
    }

    public function edit(SpaceSection $space_section)
    {
        $space_section->load(['cards' => function ($q) {
            $q->ordered();
        }]);

        return view('admin.space_sections.edit', [
            'section' => $space_section,
        ]);
    }

    public function update(Request $request, SpaceSection $space_section)
    {
        $data = $request->validate([
            'badge' => ['nullable', 'string', 'max:255'],
            'badge_icon' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string'],
            'background_color' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $space_section->update($data);

        return redirect()->route('admin.space_sections.edit', $space_section)->with('status', 'Section mise à jour.');
    }
}
