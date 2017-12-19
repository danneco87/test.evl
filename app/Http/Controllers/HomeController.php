<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     *
     * Create a new controller instance.
     *
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * Roles implemented
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Logic that determines where to send the user
        if ($request->user()->hasRole('admin')) {
            return redirect('/admin/home');
        }

        if ($request->user()->hasRole('manager')) {
            return view('home');
        }

        return abort(401, 'This action is unauthorized.');
    }
}
