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
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'pixel_id' => ['nullable', 'string', 'max:64'],
            'enabled' => ['nullable', 'boolean'],
        ]);

        $pixelId = trim((string) ($data['pixel_id'] ?? ''));
        $enabled = (bool) ($data['enabled'] ?? false);

        SiteSetting::setValue('facebook_pixel_id', $pixelId !== '' ? $pixelId : null);
        SiteSetting::setValue('facebook_pixel_enabled', $enabled ? '1' : '0');

        return redirect()
            ->route('admin.settings.facebook-pixel.edit')
            ->with('success', 'Facebook Pixel mis à jour.');
    }
}
