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

            $view->with('headerMenus', $headerMenus);
        });
    }
}
