<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class FacebookPixelController extends Controller
{
    public function edit()
    {
        $pixelId = SiteSetting::getValue('facebook_pixel_id', '');
        $enabledRaw = SiteSetting::getValue('facebook_pixel_enabled', '0');
        $enabled = in_array((string) $enabledRaw, ['1', 'true', 'on', 'yes'], true);

        return view('admin.settings.facebook-pixel', [
            'pixelId' => $pixelId,
            'enabled' => $enabled,
            'activeId' => \App\Support\MetaPixel::id(),
            'envId' => config('services.meta_pixel_id'),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'pixel_id' => ['nullable', 'regex:/^\s*\d{10,20}\s*$/', 'required_if:enabled,1'],
            'enabled' => ['nullable', 'boolean'],
        ], [
            'pixel_id.regex' => "L'identifiant du Pixel ne contient que des chiffres (15 à 16 en général), ex. 123456789012345.",
            'pixel_id.required_if' => "Renseignez l'identifiant du Pixel pour l'activer.",
        ]);

        $pixelId = trim((string) ($data['pixel_id'] ?? ''));
        $enabled = (bool) ($data['enabled'] ?? false);

        SiteSetting::setValue('facebook_pixel_id', $pixelId !== '' ? $pixelId : null);
        SiteSetting::setValue('facebook_pixel_enabled', $enabled ? '1' : '0');
        \App\Support\MetaPixel::forget();

        return redirect()
            ->route('admin.settings.facebook-pixel.edit')
            ->with('success', $enabled ? 'Pixel activé : il est chargé sur toutes les pages du site.' : 'Pixel enregistré mais désactivé : il n’est pas chargé sur le site.');
    }
}
