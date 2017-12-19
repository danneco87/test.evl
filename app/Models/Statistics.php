<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    /**
 * The table associated with the model.
 *
 * @var string
 */
    protected $table = 'statistics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'scored_goal',
        'scored_penalty',
        'missed_penalty',
        'stopped_penalty',
        'assist',
        'yellow_card',
        'red_card',
        'player_id',
        'game_week',
        'match_day',
        'season'
    ];

    public function players()
    {
        return $this->belongsTo('App\Models\Players', 'player_id');
    }

    public function getTopGoals()
    {
        $goals   = new Statistics();
        $players = $goals->orderBy('scored_goal', 'DESC')->limit(10)->get();

        if (!count($players)) {
            $players = new Players();
            $players = $players->getPlayers(10);
        }

        return $players;
    }
}
