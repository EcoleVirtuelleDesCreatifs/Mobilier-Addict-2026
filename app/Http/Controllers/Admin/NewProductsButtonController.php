<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class NewProductsButtonController extends Controller
{
    public function edit()
    {
        $buttonText = SiteSetting::getValue('new_products_button_text', 'Voir plus de nouveaux produits');
        $buttonUrl = SiteSetting::getValue('new_products_button_url', route('nouveautes.index'));
        $buttonEnabledRaw = SiteSetting::getValue('new_products_button_enabled', '1');
        $buttonEnabled = in_array((string) $buttonEnabledRaw, ['1', 'true', 'on', 'yes'], true);

        return view('admin.settings.new-products-button', [
            'buttonText' => $buttonText,
            'buttonUrl' => $buttonUrl,
            'buttonEnabled' => $buttonEnabled,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:500'],
            'button_enabled' => ['nullable', 'boolean'],
        ]);

        $buttonText = trim((string) ($data['button_text'] ?? ''));
        $buttonUrl = trim((string) ($data['button_url'] ?? ''));
        $buttonEnabled = (bool) ($data['button_enabled'] ?? false);

        SiteSetting::setValue('new_products_button_text', $buttonText !== '' ? $buttonText : 'Voir plus de nouveaux produits');
        SiteSetting::setValue('new_products_button_url', $buttonUrl !== '' ? $buttonUrl : route('nouveautes.index'));
        SiteSetting::setValue('new_products_button_enabled', $buttonEnabled ? '1' : '0');

        return redirect()
            ->route('admin.settings.new-products-button.edit')
            ->with('success', 'Bouton "Nouveaux produits" mis à jour.');
    }
}
