<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowMetaTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('show_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tvmaze_id');
            $table->integer('show_id');
            $table->tinyInteger('season');
            $table->tinyInteger('episode');
            $table->text('name')->nullable();
            $table->date('schedule')->nullable();
            $table->text('magnet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('show_meta');
    }
}
