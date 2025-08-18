<?php

namespace App\Providers;

use App\Models\FooterSection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\NavbarSection;
use App\Models\Visitor;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('partials.header', function ($view) {
            $view->with('navbarSection', NavbarSection::with('links')->first());
        });

        View::composer('partials.footer', function ($view) {
        $view->with('footerSection', FooterSection::with('details')->first());
    });

        Paginator::useBootstrapFive();
    }
}
