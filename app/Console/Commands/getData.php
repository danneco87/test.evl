<?php

namespace App\Console\Commands;

use App\Models\Matches;
use App\Models\Players;
use App\Models\Teams;
use GuzzleHttp;
use Illuminate\Console\Command;

class getData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:data {id}{gameWeek?}{start?}{end?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill teams/players';

    /**
     *
     * Create a new command instance.
     *
     * getData constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Get command arguments
        $id       = $this->argument('id');
        $gameWeek = $this->argument('gameWeek');
        $start    = $this->argument('start');
        $end      = $this->argument('end');
        //$this->info('Teams command recreate the teams and players from eredivisie. Starting:');
        //        $this->getTeams($id);
        //        $this->getPlayers();
        $this->info('Now adding matches:');
        if (isset($gameWeek) && isset($start) && isset($end)) {
            $this->getMatches($id, $gameWeek, $start, $end);
        } else {
            $this->info('If you want to add matches please add all arguments to commands! Example: 77 1 2017-08-11 2017-08-14');
        }
        $this->info('Work is done!');

        return null;
    }

    private function getTeams($id = null)
    {
        $this->info('Checking if teams are in database, otherwise making call to API');

        $teams = Teams::all();

        if ($teams->isEmpty()) {
            $this->info('Database is empty. Teams will be added.');
            $teams = $this->getApiTeams($id);
            $this->saveTeams($teams);
            $this->info('All teams were populated from API to database.');
        } else {
            $this->info('Teams are already added. Please update changes thru admin panel');
        }

        return $teams;
    }

    private function saveTeams($teams)
    {
        foreach ($teams as $key => $team) {
            $data             = new Teams();
            $data->name       = $team['name'];
            $data->short_name = $team['shortName'];
            $data->season     = '2017/2018';
            $data->api_id     = $team['dbid'];
            $data->save();
            $this->info('Team:' . ' ' . $team['name'] . '-' . 'ID:' . ' ' . $team['dbid'] . ' ' . 'added to database');
        }
    }

    private function getApiTeams($id)
    {
        $client   = new GuzzleHttp\Client();
        $key      = '4bdb4d8db2af45a7a44f90c19b3f9abd';
        $response = $client->get(
            'https://api.crowdscores.com/v1/teams?competition_ids=' . $id,
            [
                'headers' => [
                    "x-crowdscores-api-key" => $key,
                    'Content-type'          => 'application/json'
                ]
            ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    private function getPlayers()
    {
        $this->info('Checking if players are in database, otherwise making call to API');
        $teams = $this->getTeams();
        foreach ($teams as $team) {
            $players = new Players();
            $data    = $players->where('team_id', $team->id)->get();
            if ($data->isEmpty()) {
                $this->info('No players found, calling API.');
                $players = $this->getApiPlayers($team->api_id);
                $this->info('Adding players to database:');
                $this->savePlayers($players, $team->name, $team->id);
            }
        }


        return $teams;
    }

    private function savePlayers($players, $name, $id)
    {
        foreach ($players['players'] as $key => $player) {
            $data                = new Players();
            $data->name          = $player['name'];
            $data->position      = $player['position'];
            $data->age           = 0;
            $data->nationality   = 'unknown';
            $data->status        = 1;
            $data->team_id       = $id;
            $data->api_player_id = $player['dbid'];
            $data->save();
            $this->info($player['name'] . ' ' . 'from' . ' ' . $name . ' ' . 'was added to database');
        }

    }

    private function getApiPlayers($id)
    {
        $client   = new GuzzleHttp\Client();
        $key      = '4bdb4d8db2af45a7a44f90c19b3f9abd';
        $response = $client->get(
            'https://api.crowdscores.com/v1/teams/' . $id,
            [
                'headers' => [
                    "x-crowdscores-api-key" => $key,
                    'Content-type'          => 'application/json'
                ]
            ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    private function getMatches($id, $gameWeek, $start, $end)
    {
        $this->info('Adding matches to database, making call to API');
        $matches = $this->getApiMatches($id, $start, $end);
        $this->saveMatches($matches, $gameWeek);
    }

    private function saveMatches($matches, $gameWeek)
    {
        foreach ($matches as $key => $match) {
            $data             = new Matches();
            $data->home_id    = $this->getTeamId($match['homeTeam']['dbid']);
            $data->away_id    = $this->getTeamId($match['awayTeam']['dbid']);
            $data->home_goals = $match['homeGoals'];
            $data->away_goals = $match['awayGoals'];
            $data->match_day  = date('Y-m-d');
            $data->game_week  = $gameWeek;
            $data->season     = $match['season']['name'];
            $data->save();
            $this->info($match['homeTeam']['name'] . ' ' . 'vs' . ' ' . $match['awayTeam']['name'] . ' ' . 'was added to database');
        }

    }

    private function getApiMatches($id, $start, $end)
    {
        $client   = new GuzzleHttp\Client();
        $key      = '4bdb4d8db2af45a7a44f90c19b3f9abd';
        $response = $client->get(
        //'https://api.crowdscores.com/v1/playerstats?team_ids='. $id.'&season_id='. 15,
        //'https://api.crowdscores.com/v1/rounds?competition_id='. $id,
            'https://api.crowdscores.com/v1/matches?competition_id=' . $id . '&from=' . $start . 'T00:00:00-00:00&to=' . $end . 'T00:00:00-00:00',
            [
                'headers' =>
                    [
                        "x-crowdscores-api-key" => $key,
                        'Content-type'          => 'application/json'
                    ]
            ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    private function getTeamId($id)
    {
        $team = new Teams();
        $id   = $team->getTeamId($id);

        return $id->id;
    }
}
