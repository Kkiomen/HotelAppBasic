<?php

namespace App\Providers;

use App\Enums\RolesType;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Request;
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
            $clientMenuItem = [];
            $employeeMenuItem = [];

            if(in_array(Request::user()?->roles, [RolesType::CLIENT->value, RolesType::ADMINISTRATOR->value])){
                $clientMenuItem = [
                    NavigationItem::make(Lang::get('product_description.navigation'))
                        ->url(route('filament.resources.hotels.index'), shouldOpenInNewTab: false)
                        ->icon('bi-text-left')
                        ->isActiveWhen(fn (): bool => request()->routeIs(route('filament.resources.hotels.index')))
                        ->activeIcon('bi-text-indent-right')
                        ->sort(1),
                ];
            }

            if(in_array(Request::user()?->roles, [RolesType::EMPLOYEE->value, RolesType::CLIENT->value, RolesType::ADMINISTRATOR->value])){
                $employeeMenuItem = [
                    NavigationItem::make(Lang::get('product_description.navigation'))
                        ->url(route('filament.resources.rooms.index'), shouldOpenInNewTab: false)
                        ->icon('bi-text-left')
                        ->isActiveWhen(fn (): bool => request()->routeIs(route('filament.resources.rooms.index')))
                        ->activeIcon('bi-text-indent-right')
                        ->sort(2),
                ];
            }


            Filament::registerNavigationItems(array_merge(
                $clientMenuItem,
                $employeeMenuItem,
            ));
        });
    }
}
