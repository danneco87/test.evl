<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home_id');
            $table->integer('away_id');
            $table->integer('home_goals');
            $table->integer('away_goals');
            $table->string('game_week');
            $table->date('match_day');
            $table->string('season');
            $table->timestamps();
            $table->index('home_id');
            $table->index('away_id');
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
        Schema::dropIfExists('matches');
    }
}
