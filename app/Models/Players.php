<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'players';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'position',
        'age',
        'nationality',
        'status',
        'team_id',
        'api_player_id'
    ];

    public function teams()
    {
        return $this->hasOne('App\Models\Teams', 'team_id');
    }

    public function stats()
    {
        return $this->hasMany(Statistics::class);
    }

    public function getPlayers($limit)
    {
        $players = new Players();
        $players = $players->inRandomOrder()->limit($limit)->get();

        return $players;
    }

    public function getTeamPlayers($id)
    {
        return Players::all()->where('team_id', '=', $id);
    }


}
