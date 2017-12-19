<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSquadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('squad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->integer('selection_id')->unsigned();
            $table->timestamps();
            $table->index('team_id');
            $table->index('player_id');
            $table->index('selection_id');
            $table->foreign('team_id')
                  ->references('id')->on('teams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('player_id')
                  ->references('id')->on('players')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('selection_id')
                  ->references('id')->on('selection')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('squad');
    }
}
