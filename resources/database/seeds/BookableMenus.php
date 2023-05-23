<?php

namespace Modules\Bookable\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\MenuProxy;
use Modules\Core\Models\MenuItemProxy;

class BookableMenus extends Seeder {

    public function run() {
        $mainMenu = MenuProxy::where('name', 'Main Menu')->first();

        $videoMenuItem = MenuItemProxy::create([
                    "name" => 'Book an Appointment',
                    "url" => 'bookable.index',
                    "menu_id" => $mainMenu->id,
                    'is_internal' => 1
        ]);
    }

}
