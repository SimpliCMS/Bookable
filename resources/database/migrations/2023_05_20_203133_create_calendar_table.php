<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarTable extends Migration {

    public function up() {
        Schema::create('calendar', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('calendar');
    }

}
