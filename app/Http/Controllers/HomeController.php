<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')
            ->where('guest', '1')
            ->count();
        $staffs = DB::table('users')
            ->where('guest', '0')
            ->count();

            $emails = DB::table('messages')
            ->where('type', 'EMAIL')
            ->count();

            $sms = DB::table('messages')
            ->where('type', 'SMS')
            ->count();
        // return view('home')->with(['users' => $users]);
        return view('home', compact(['staffs', 'users','sms','emails']));
    }
}
