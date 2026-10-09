<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PublicMediaController extends Controller
{
    public function show(string $path): BinaryFileResponse
    {
        $path = ltrim(str_replace('\\', '/', rawurldecode($path)), '/');

        abort_if($path === '' || Str::contains($path, ['../', "\0"]), 404);
        abort_unless(preg_match('/\.(avif|gif|jpe?g|png|webp)$/i', $path), 404);

        $file = storage_path('app/public/' . $path);
        abort_unless(is_file($file), 404);

        return response()->file($file, [
            'Cache-Control' => 'public, max-age=604800, immutable',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
