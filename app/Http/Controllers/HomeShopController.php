<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeShopController extends Controller
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
        return view('home_shop', [
            'link_requests' => Auth::user()->link_requests->where('accept_flg', false),
            // 'link_requests' => Auth::user()->link_requests
            'shops' => Auth::user()->shops,
        ]);
    }
}
