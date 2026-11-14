<?php

namespace App\Providers;

use App\Models\Menu;
use App\Support\ImageUrl;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('dompdf.wrapper', function ($app) {
            return new \Barryvdh\DomPDF\PDF($app['dompdf']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Paginator::useBootstrapFive();
        Paginator::defaultView('pagination::bootstrap-5');
        Paginator::defaultSimpleView('pagination::simple-bootstrap-5');

        Blade::directive('image_url', function ($expression) {
            return "<?php echo \\" . ImageUrl::class . "::url({$expression}); ?>";
        });

        View::addExtension('blade.php', 'blade');

        $headerMenusComposer = function ($view) {
            $headerMenus = Menu::query()
                ->active()
                ->where('position', 'header')
                ->whereNull('parent_id')
                ->with(['children'])
                ->orderBy('order')
                ->get()
                // Audit : masquer les univers vides (sans produit actif,
                // sauf s'ils ont un lien personnalisé ou des sous-menus).
                ->filter(function ($menu) {
                    if (trim((string) $menu->url) !== '' || $menu->children->isNotEmpty()) {
                        return true;
                    }

                    return $menu->products()->where('products.is_active', true)->exists();
                })
                ->values();

            $view->with('headerMenus', $headerMenus);
        };

        View::composer('partials.header', $headerMenusComposer);
        View::composer('maquette.includes.header', $headerMenusComposer);
        // Le menu mobile est inclus directement dans le layout.
        View::composer('maquette.layout', $headerMenusComposer);
    }
}
