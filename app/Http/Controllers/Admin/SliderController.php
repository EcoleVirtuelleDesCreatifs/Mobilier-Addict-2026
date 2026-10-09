<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Support\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slide::query()->orderBy('order')->paginate(15)->withQueryString();

        return view('admin.articles.slider', [
            'sliders' => $sliders,
        ]);
    }

    public function create()
    {
        return view('admin.articles.slider-create');
    }

    public function store(Request $request)
    {
        $data = $this->validateSlide($request);
        $data = $this->normalize($data);

        if ($request->hasFile('image')) {
            $data['image'] = ImageOptimizer::storeStoragePublic($request->file('image'), 'slides', 1600, 80);
        }

        Slide::create($data);

        return redirect()->route('admin.slider.index')->with('success', 'Slide ajouté avec succès.');
    }

    public function edit(Slide $slider)
    {
        return view('admin.articles.slider-edit', [
            'slider' => $slider,
        ]);
    }

    public function update(Request $request, Slide $slider)
    {
        $data = $this->validateSlide($request, true);
        $data = $this->normalize($data);

        if ($request->hasFile('image')) {
            $data['image'] = ImageOptimizer::storeStoragePublic($request->file('image'), 'slides', 1600, 80);
        }

        $slider->update($data);

        return redirect()->route('admin.slider.index')->with('success', 'Slide mis à jour avec succès.');
    }

    public function destroy(Slide $slider)
    {
        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Slide supprimé avec succès.');
    }

    private function validateSlide(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'badge' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'title_highlight' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => [$isUpdate ? 'nullable' : 'required', 'image', 'max:4096'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'btn_primary_text' => ['nullable', 'string', 'max:255'],
            'btn_primary_url' => ['nullable', 'string', 'max:255'],
            'btn_secondary_text' => ['nullable', 'string', 'max:255'],
            'btn_secondary_url' => ['nullable', 'string', 'max:255'],
            'discount_text' => ['nullable', 'string', 'max:255'],
            'discount_label' => ['nullable', 'string', 'max:255'],
            'stat1_value' => ['nullable', 'string', 'max:255'],
            'stat1_label' => ['nullable', 'string', 'max:255'],
            'stat2_value' => ['nullable', 'string', 'max:255'],
            'stat2_label' => ['nullable', 'string', 'max:255'],
            'stat3_value' => ['nullable', 'string', 'max:255'],
            'stat3_label' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);
    }

    private function normalize(array $data): array
    {
        $data['badge'] = $data['badge'] ?? null;
        $data['title_highlight'] = $data['title_highlight'] ?? null;
        $data['description'] = $data['description'] ?? null;
        $data['image_alt'] = $data['image_alt'] ?? null;

        $data['btn_primary_text'] = $data['btn_primary_text'] ?? null;
        $data['btn_primary_url'] = $data['btn_primary_url'] ?? null;
        $data['btn_secondary_text'] = $data['btn_secondary_text'] ?? null;
        $data['btn_secondary_url'] = $data['btn_secondary_url'] ?? null;

        $data['discount_text'] = $data['discount_text'] ?? null;
        $data['discount_label'] = $data['discount_label'] ?? null;

        $data['stat1_value'] = $data['stat1_value'] ?? null;
        $data['stat1_label'] = $data['stat1_label'] ?? null;
        $data['stat2_value'] = $data['stat2_value'] ?? null;
        $data['stat2_label'] = $data['stat2_label'] ?? null;
        $data['stat3_value'] = $data['stat3_value'] ?? null;
        $data['stat3_label'] = $data['stat3_label'] ?? null;

        $data['order'] = $data['order'] ?? 0;
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        foreach (['btn_primary_url', 'btn_secondary_url'] as $key) {
            if (!empty($data[$key]) && is_string($data[$key])) {
                $data[$key] = trim($data[$key]);
            }
        }

        return $data;
    }
}
