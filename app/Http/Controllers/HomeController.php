<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function customerHome()
    // {
    //     return view('home', ["msg" => "I am customer role"]);
    // }

    // public function adminHome()
    // {
    //     return view('home', ["msg" => "I am admin role"]);
    // }
}
