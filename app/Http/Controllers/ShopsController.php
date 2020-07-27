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
        // ログインユーザが店舗の管理ユーザの時のみブログを作成可能
        if (Auth::user()->id == $shop->user_id) {
            $this->validate($req, \App\Shop::$rules);
            $shop->fill($req->all())->save();
            return redirect('/shops/'. $shop->id);
        }
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

    // get /link_requests/{link_request}/connect
    public function connect(\App\LinkRequest $link_request)
    {
        return view('shops.connect', [
            'shop' => $link_request->shop,
            'user' => $link_request->user,
            'link_request' => $link_request,
        ]);
    }

    // post /link_requests/{link_request}/connect
    public function linkage(Request $req, \App\LinkRequest $link_request)
    {
        $this->validate($req, [
            'agreed' => 'accepted'
        ]);

        \DB::beginTransaction();
        try {
            $shop = $link_request->shop;
            $shop->user_id = $link_request->user_id;
            $link_request->accept_flg = true;
            $link_request->save();
            $shop->save();
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
        }

        return redirect('/home_admin');
    }
}
