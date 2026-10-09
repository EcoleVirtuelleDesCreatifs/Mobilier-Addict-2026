<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageView;
use Carbon\Carbon;

class PageViewSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        // Generate test visitor data for the last hour
        $visitorIds = [];
        for ($i = 0; $i < 50; $i++) {
            $visitorIds[] = 'visitor_test_' . $i;
        }

        $urls = [
            'https://mobilier-addict.com/',
            'https://mobilier-addict.com/matelas',
            'https://mobilier-addict.com/menu/matelas',
            'https://mobilier-addict.com/categories/medicosoins',
            'https://mobilier-addict.com/categories/confort_soft',
            'https://mobilier-addict.com/menu/electromenager',
            'https://mobilier-addict.com/menu/mobilier-accessoire',
        ];

        // Create page views for the last hour (simulating current visitors)
        for ($i = 0; $i < 20; $i++) {
            $visitorId = $visitorIds[array_rand($visitorIds)];
            $url = $urls[array_rand($urls)];
            
            PageView::create([
                'visitor_id' => $visitorId,
                'user_id' => null,
                'route_name' => null,
                'path' => parse_url($url, PHP_URL_PATH),
                'full_url' => $url,
                'referer' => null,
                'ip' => '192.168.1.' . rand(1, 255),
                'user_agent' => 'Mozilla/5.0 (Test Browser)',
                'created_at' => $now->copy()->subMinutes(rand(0, 5)),
            ]);
        }

        // Create page views for the last hour (more visitors)
        for ($i = 0; $i < 30; $i++) {
            $visitorId = $visitorIds[array_rand($visitorIds)];
            $url = $urls[array_rand($urls)];
            
            PageView::create([
                'visitor_id' => $visitorId,
                'user_id' => null,
                'route_name' => null,
                'path' => parse_url($url, PHP_URL_PATH),
                'full_url' => $url,
                'referer' => null,
                'ip' => '192.168.1.' . rand(1, 255),
                'user_agent' => 'Mozilla/5.0 (Test Browser)',
                'created_at' => $now->copy()->subMinutes(rand(5, 60)),
            ]);
        }

        // Create page views for today
        for ($i = 0; $i < 100; $i++) {
            $visitorId = $visitorIds[array_rand($visitorIds)];
            $url = $urls[array_rand($urls)];
            
            PageView::create([
                'visitor_id' => $visitorId,
                'user_id' => null,
                'route_name' => null,
                'path' => parse_url($url, PHP_URL_PATH),
                'full_url' => $url,
                'referer' => null,
                'ip' => '192.168.1.' . rand(1, 255),
                'user_agent' => 'Mozilla/5.0 (Test Browser)',
                'created_at' => $now->copy()->subHours(rand(1, 24)),
            ]);
        }
    }
}
