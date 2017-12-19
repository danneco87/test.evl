<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('scored_goal');
            $table->integer('scored_penalty');
            $table->integer('missed_penalty');
            $table->integer('stopped_penalty');
            $table->integer('assist');
            $table->integer('yellow_card');
            $table->integer('red_card');
            $table->integer('player_id');
            $table->string('game_week');
            $table->date('match_day');
            $table->string('season');
            $table->timestamps();
            $table->index('scored_goal');
            $table->index('scored_penalty');
            $table->index('missed_penalty');
            $table->index('stopped_penalty');
            $table->index('assist');
            $table->index('yellow_card');
            $table->index('red_card');
            $table->index('game_week');
            $table->index('match_day');
            $table->index('season');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
