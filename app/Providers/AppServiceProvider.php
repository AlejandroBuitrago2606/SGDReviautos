<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Proceso;
use App\Models\TipoDocumento;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
        
            if (config('app.env') === 'local') {

                $this->app['request']->server->set('HTTPS', true);
            }
        
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('masterpages.dashboard', function ($view) {
            $view->with('lista_procesos', Proceso::all())
                ->with('lista_categorias', TipoDocumento::all());
        });
    }
}
