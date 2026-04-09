<?php

namespace App\Providers;

use App\Models\Menu;
use App\Support\ImageUrl;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::defaultView('pagination::bootstrap-5');
        Paginator::defaultSimpleView('pagination::simple-bootstrap-5');

        Blade::directive('image_url', function ($expression) {
            return "<?php echo \\" . ImageUrl::class . "::url({$expression}); ?>";
        });

        View::addExtension('blade.php', 'blade');

        View::composer('partials.header', function ($view) {
            $headerMenus = Menu::query()
                ->active()
                ->where('position', 'header')
                ->whereNull('parent_id')
                ->with(['children'])
                ->orderBy('order')
                ->get();

            $bedroomSlugs = ['matelas', 'oreillers-et-taies', 'drap-et-couettes'];
            $bedroomMenus = $headerMenus->filter(function ($m) use ($bedroomSlugs) {
                return in_array(strtolower((string) ($m->slug ?? '')), $bedroomSlugs, true);
            })->values();

            if ($bedroomMenus->count() > 1) {
                $headerMenus = $headerMenus->reject(function ($m) use ($bedroomSlugs) {
                    return in_array(strtolower((string) ($m->slug ?? '')), $bedroomSlugs, true);
                })->values();

                $orderedBedroomMenus = collect($bedroomSlugs)
                    ->map(function ($slug) use ($bedroomMenus) {
                        return $bedroomMenus->first(fn ($m) => strtolower((string) ($m->slug ?? '')) === $slug);
                    })
                    ->filter()
                    ->values();

                $chambreMenu = (object) [
                    'name' => 'Chambre',
                    'slug' => 'chambre',
                    'url' => '#',
                    'icon' => 'fa-solid fa-bed',
                    'open_new_tab' => false,
                    'children' => $orderedBedroomMenus,
                ];

                $homeMenu = $headerMenus->first(function ($m) {
                    return in_array(strtolower((string) ($m->slug ?? '')), ['accueil', 'home'], true);
                });

                if ($homeMenu) {
                    $headerMenus = $headerMenus
                        ->reject(function ($m) {
                            return in_array(strtolower((string) ($m->slug ?? '')), ['accueil', 'home'], true);
                        })
                        ->prepend($homeMenu)
                        ->values();

                    $headerMenus = $headerMenus
                        ->splice(0, 1)
                        ->concat(collect([$chambreMenu]))
                        ->concat($headerMenus)
                        ->values();
                } else {
                    $headerMenus = $headerMenus->prepend($chambreMenu);
                }
            }

            $view->with('headerMenus', $headerMenus);
        });
    }
}
