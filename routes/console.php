<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Support\ImageOptimizer;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('images:optimize {--max=1600} {--quality=80} {--dry-run}', function () {
    $max = (int) $this->option('max');
    $quality = (int) $this->option('quality');
    $dryRun = (bool) $this->option('dry-run');

    $targets = [
        public_path('uploads'),
        storage_path('app/public'),
    ];

    $optimized = 0;
    $skipped = 0;

    foreach ($targets as $base) {
        if (!is_dir($base)) {
            continue;
        }

        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($base, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($it as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }

            $path = $fileInfo->getPathname();
            $ext = strtolower((string) $fileInfo->getExtension());
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) {
                $skipped++;
                continue;
            }

            if ($dryRun) {
                $optimized++;
                continue;
            }

            $ok = ImageOptimizer::optimizeFileInPlace($path, $max, $quality);
            if ($ok) {
                $optimized++;
            } else {
                $skipped++;
            }
        }
    }

    $this->info('Optimized: ' . $optimized);
    $this->info('Skipped: ' . $skipped);
})->purpose('Optimize existing images (public/uploads + storage/app/public)');
