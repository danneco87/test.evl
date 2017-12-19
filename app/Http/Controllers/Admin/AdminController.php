<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teams;
use App\Models\Statistics;
class AdminController extends Controller
{
    /**
     *
     * HomeController constructor.
     *
     * Instantiate a new controller instance.
     *
     * @param Request $request
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $teams   = Teams::all();
        $players = new Statistics();
        $goals   = $players->getTopGoals();

        return view('admin/home')->with(compact('teams', 'counter', 'goals'));
    }
}
