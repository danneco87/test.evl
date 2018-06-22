<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use App\Models\Teams;
use App\Models\Statistics;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\View\Helpers\MatchesHelper;
class AdminController extends CrudController
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        // Check is user is Admin
        $request->user()->authorizeRoles(['admin']);

        // Variables
        $teams   = Teams::all();
        $players = new Statistics();
        $goals   = $players->getTopGoals();
        $stats = new MatchesHelper();

        return view('admin/home')->with(compact('teams', 'counter', 'goals', 'stats'));
    }

    public function createUser()
    {

    }
}
