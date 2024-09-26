<?php

namespace App\Providers;

use App\View\Composers\MenuComposer;
use App\View\Composers\SettingsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['admin.*'], MenuComposer::class);
        View::composer(['admin.*'], SettingsComposer::class);

    }
}
