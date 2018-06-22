<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Statistics;
use App\Models\Teams;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display all teams dutch league.
     *
     * @param Request $request
     *
     * @return $this
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $teams = Teams::all();
        $stats = new Statistics();
        $goals = $stats->getTopGoals();

        return view('eredivisie/teams')->with(compact('teams', 'counter', 'goals', 'players'));
    }

    /**
     * Display single team page
     *
     * @param $id
     *
     * @return $this
     */
    public function team($id)
    {
        $init    = new Teams();
        $teams   = $init->where('id', $id)->first();
        $players = $init->playersPerTeam($id);
        $stats   = new Statistics();
        $goals   = $stats->getTopGoals();

        return view('eredivisie/team')->with(compact('teams', 'counter', 'goals', 'players'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eredivisie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required',
            'short_name' => 'required',
            'season'     => 'required',
        ]);
        $new = new Teams();
        $new->create($request->all());

        return redirect()->route('teams.index')
                         ->with('success', 'Team created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Teams $teams
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Teams $teams, $id)
    {
        $teams->find($id);

        return view('eredivisie.teams', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Teams $teams
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Teams $teams, $id)
    {
        $teams->find($id);

        return view('eredivisie.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Teams $teams
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teams $teams)
    {
        request()->validate([
            'name'      => 'required',
            'shortname' => 'required',
            'season'    => 'required',
        ]);
        $teams->update($request->all());

        return redirect()->route('eredivisie/teams')
                         ->with('success', 'Team updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Teams $teams
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Teams $teams, $id)
    {
        $teams->find($id)->delete();

        return redirect()->route('eredivisie.teams')
                         ->with('success', 'Team deleted successfully');
    }
}
