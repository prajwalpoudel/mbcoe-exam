<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class CustomHeadingRowFormatter extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        HeadingRowFormatter::extend('custom', function($value, $key) {
            return getStrAsRow($value);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
