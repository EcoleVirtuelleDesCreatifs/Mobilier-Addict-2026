<?php

namespace App\Providers;

use App\Models\Menu;
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
        Blade::directive('image_url', function ($expression) {
            return "<?php echo image_url({$expression}); ?>";
        });

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
