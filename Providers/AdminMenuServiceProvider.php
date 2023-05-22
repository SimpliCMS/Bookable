<?php

namespace Modules\Bookable\Providers;

use Illuminate\Support\ServiceProvider;
use Konekt\Menu\Facades\Menu;

class AdminMenuServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        $this->app->booted(function () {
            // Add default menu items to sidebar
            if ($adminMenu = Menu::get('admin')) {

                $bookable = $adminMenu->addItem('bookable', __('Bookables'))->data('order', 11);
                $bookable->addSubItem('calendar', __('Calendar'), ['route' => 'bookable.admin.calendar.index'])
                        ->activateOnUrls($this->routeWildcard('bookable.admin.calendar.index'));
                $bookable->addSubItem('services', __('Services'), ['route' => 'bookable.admin.index'])
                        ->activateOnUrls($this->routeWildcard('bookable.admin.index'));
            }
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    private function routeWildcard(string $route): string {
        if (0 === strlen($path = parse_url(route($route), PHP_URL_PATH))) {
            return '';
        }

        if ('/' === $path[0]) {
            $path = substr($path, 1);
        }

        return "$path*";
    }

}
