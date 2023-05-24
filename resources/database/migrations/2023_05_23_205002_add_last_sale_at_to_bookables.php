<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastSaleAtToBookables extends Migration {

    public function up() {
        Schema::table('bookables', function (Blueprint $table) {
            $table->timestamp('last_sale_at')->nullable();
        });
    }

    public function down() {
    }

}
