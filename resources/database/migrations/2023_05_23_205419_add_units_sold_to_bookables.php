<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitsSoldToBookables extends Migration {

    public function up() {
        Schema::table('bookables', function (Blueprint $table) {
            $table->integer('units_sold')->default(0);
        });
    }

    public function down() {
        //
    }

}
