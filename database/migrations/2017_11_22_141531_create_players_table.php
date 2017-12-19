<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('position', 52);
            $table->integer('age');
            $table->string('nationality', 52);
            $table->enum('status', ['active', 'injured', 'transferred', 'banned']);
            $table->integer('team_id')->unsigned();
            $table->integer('api_player_id');
            $table->timestamps();
            $table->index('team_id');
            $table->index('age');
            $table->index('status');
            $table->index('name');
            $table->index('nationality');
            $table->foreign('team_id')
                  ->references('id')->on('teams')
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
        Schema::dropIfExists('players');
    }
}
