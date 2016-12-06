<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('shows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tvmaze_id');
            $table->string('name');
            $table->text('summary')->nullable();
            $table->time('schedule');
            $table->string('cover')->nullable();
            $table->integer('season')->default(0);
            $table->integer('episode')->default(0);
            $table->integer('p_episode')->default(0);
            $table->integer('n_episode')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('shows');
    }
}
