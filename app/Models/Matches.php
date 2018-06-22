<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Matches
 *
 * @mixin \Eloquent
 */
class Matches extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'home_id',
        'away_id',
        'home_goals',
        'away_goals',
        'game_week',
        'match_day',
        'season'
    ];

    protected static function getMatches($id)
    {
        return Matches::where('home_id', '=', $id)->orWhere('away_id', $id)->count();
    }

    protected static function getWinners($id)
    {
        $homeWins = Matches::where('home_id', $id)
                           ->whereColumn('home_goals', '>', 'away_goals')
                           ->count();
        $awayWins = Matches::where('away_id', $id)
                           ->whereColumn('away_goals', '>', 'home_goals')
                           ->count();

        $wins = $homeWins + $awayWins;


        return $wins;
    }

    protected static function getDraws($id)
    {
        $homeDraws = Matches::where('home_id', $id)
                            ->whereColumn('home_goals', '=', 'away_goals')
                            ->count();
        $awayDraws = Matches::where('away_id', $id)
                            ->whereColumn('home_goals', '=', 'away_goals')
                            ->count();
        $draws     = $homeDraws + $awayDraws;

        return $draws;
    }

    protected static function getLosses($id)
    {
        return (self::getMatches($id) - (self::getWinners($id) + self::getDraws($id)));
    }

    protected static function getHomeGoals($id)
    {
        return Matches::where('home_id', $id)->sum('home_goals');
    }

    protected static function getHomeAgainsGoals($id)
    {
        return Matches::where('home_id', $id)->sum('away_goals');
    }

    protected static function getAwayGoals($id)
    {
        return Matches::where('away_id', $id)->sum('away_goals');
    }

    protected static function getAwayAgainstGoals($id)
    {
        return Matches::where('away_id', $id)->sum('home_goals');
    }

    protected static function goalsDiffence($id)
    {
        return ((self::getHomeGoals($id) + self::getAwayGoals($id)) - ((self::getHomeAgainsGoals($id)) + (self::getAwayAgainstGoals($id))));
    }

    protected static function getPoints($id)
    {
        return ((self::getWinners($id) * 3) + (self::getDraws($id)));
    }

    public static function getMatchData($id)
    {
        $data = [
            'matches'         => self::getMatches($id),
            'wins'            => self::getWinners($id),
            'draws'           => self::getDraws($id),
            'losses'          => self::getLosses($id),
            'goalsFor'        => (self::getHomeGoals($id) + self::getAwayGoals($id)),
            'goalsAgainst'    => (self::getHomeAgainsGoals($id)) + (self::getAwayAgainstGoals($id)),
            'goalsDifference' => self::goalsDiffence($id),
            'points'          => self::getPoints($id)
        ];

        return $data;
    }
}
