<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home_admin', [
            // 'link_requests' => \App\LinkRequest::where('accept_flg', false)->get()
            'link_requests' => \App\LinkRequest::all()
        ]);
    }
}
