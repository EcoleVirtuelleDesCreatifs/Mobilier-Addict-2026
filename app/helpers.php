<?php

use App\Support\ImageUrl;

if (!function_exists('image_url')) {
    function image_url(?string $path): string
    {
        return ImageUrl::url($path);
    }
}

if (!function_exists('whatsapp_number')) {
    function whatsapp_number(): string
    {
        $value = (string) config('app.whatsapp_number', '2250799140356');
        $value = preg_replace('/\D+/', '', $value) ?: '';
        return $value !== '' ? $value : '2250799140356';
    }
}
