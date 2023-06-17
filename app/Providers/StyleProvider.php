<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;

class StyleProvider extends ServiceProvider
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
        Filament::registerRenderHook(
            'head.end',
            fn (): View => view('components.head'),
        );
    }
}
