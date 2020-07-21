<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Shop $shop)
    {
        return view('shops.show', [
            'shop' => $shop
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Shop $shop)
    {
        return view('shops.edit', [
            'shop' => $shop
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, \App\Shop $shop)
    {
        $this->validate($req, \App\Shop::$rules);
        $shop->fill($req->all())->save();
        return redirect('/shops/'. $shop->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // get /shops/{shop}/connect
    public function connect(\App\Shop $shop)
    {
        return view('shops.connect', [
            'shop' => $shop,
        ]);
    }

    // post /shops/{shop}/connect
    public function linkage(Request $req, \App\Shop $shop)
    {
        $this->validate($req, [
            'agreed' => 'accepted'
        ]);
        $shop->user_id = Auth::user()->id;
        $shop->save();
        return redirect('/shops/'. $shop->id);
    }
}
