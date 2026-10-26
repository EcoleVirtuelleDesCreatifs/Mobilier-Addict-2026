<?php

namespace App\Console\Commands;

use App\Models\PageView;
use App\Support\GeoIp;
use App\Support\TrafficSource;
use Illuminate\Console\Command;

class BackfillTrafficOrigins extends Command
{
    protected $signature = 'analytics:backfill
                            {--geo : Géolocaliser aussi les adresses IP sans ville}
                            {--limit=300 : Nombre maximum d adresses IP à géolocaliser}';

    protected $description = 'Calcule la source de trafic et la localisation des visites déjà enregistrées';

    public function handle(): int
    {
        $host = (string) parse_url((string) config('app.url'), PHP_URL_HOST) ?: 'mobilier-addict.com';
        $count = 0;

        PageView::query()->whereNull('source')->orderBy('id')->chunkById(500, function ($rows) use ($host, &$count) {
            foreach ($rows as $row) {
                parse_str((string) parse_url((string) $row->full_url, PHP_URL_QUERY), $query);
                $row->forceFill(TrafficSource::classify((string) $row->referer, $query, (string) $row->user_agent, $host))->save();
                $count++;
            }
        });
        $this->info("Sources calculées : {$count} visites.");

        if (! $this->option('geo')) {
            $this->line('Ajoute --geo pour géolocaliser les adresses IP.');

            return self::SUCCESS;
        }

        $ips = PageView::query()->whereNull('country')->whereNotNull('ip')
            ->distinct()->limit((int) $this->option('limit'))->pluck('ip');

        $bar = $this->output->createProgressBar($ips->count());
        $located = 0;
        foreach ($ips as $ip) {
            if ($geo = GeoIp::lookup($ip)) {
                PageView::query()->where('ip', $ip)->whereNull('country')->update($geo);
                $located++;
            }
            $bar->advance();
            usleep(250000);
        }
        $bar->finish();
        $this->newLine();
        $this->info("Adresses IP localisées : {$located} / {$ips->count()}.");

        return self::SUCCESS;
    }
}
