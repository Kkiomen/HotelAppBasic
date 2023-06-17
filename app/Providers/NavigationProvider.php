<?php

namespace App\Providers;

use Filament\Navigation\NavigationItem;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
class NavigationProvider extends ServiceProvider
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
        Filament::serving(function () {

//            Filament::registerNavigationItems([
//                NavigationItem::make(Lang::get('product_description.navigation'))
//                    ->url(route('filament.pages.service/description'), shouldOpenInNewTab: false)
//                    ->icon('bi-text-left')
//                    ->isActiveWhen(fn (): bool => request()->routeIs(route('filament.pages.service/description')))
//                    ->activeIcon('bi-text-indent-right')
//                    ->group(Lang::get('basic.services'))
//                    ->sort(1),
//                NavigationItem::make(Lang::get('product_description.navigation'))
//                    ->url(route('filament.pages.service/description'), shouldOpenInNewTab: false)
//                    ->icon('bi-text-left')
//                    ->isActiveWhen(fn (): bool => request()->routeIs(route('filament.pages.service/description')))
//                    ->activeIcon('bi-text-indent-right')
//                    ->group(Lang::get('basic.services'))
//                    ->sort(2),
//            ]);
        });
    }
}
