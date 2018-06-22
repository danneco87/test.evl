<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Teams
 *
 * @mixin \Eloquent
 */
class Teams extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'short_name',
        'season',
        'api_id'
    ];


    public function getTeamId($id)
    {
        return Teams::all()->where('app_id', '=', $id)->first();
    }

    public function playersPerTeam($id)
    {
       $players = new Players();

       return $players->getTeamPlayers($id);
    }
}
