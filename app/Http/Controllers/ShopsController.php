<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LinkRequestNotification;

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
    public function create(Request $req)
    {
        return view('shops.create', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        // ログインユーザが店舗の管理ユーザの時のみブログを作成可能
        $this->validate($req, \App\Shop::$create_rules);
        $shop = new \App\Shop();
        $shop->fillWithLocation($req);
        $shop->user_id = Auth::user()->id;
        $shop->save();
        return redirect('/shops/'. $shop->id);
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
        if (Auth::user()->id == $shop->user_id) {
            if ( Auth::user()->is_shop_subscription_user() ) {
                return view('shops.edit', [
                    'shop' => $shop
                ]);
            } else if ( Auth::user()->role == 'shop' ) {
                return view('shops.publicity', [
                    'shop' => $shop
                ]);
            }
        }
    }

    public function publicity()
    {
        return view('shops.publicity', [
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
        // ログインユーザが店舗の管理ユーザの時のみブログを更新可能
        if (Auth::user()->id == $shop->user_id && Auth::user()->is_shop_subscription_user()) {
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
        // 申し込んできたユーザが申し込みユーザならば
        if (\App\User::find($link_request->user_id)->is_shop_subscription_user()) {
            if ($req->accept == 'accept') {
                \DB::beginTransaction();
                try {
                    $shop = $link_request->shop;
                    $shop->user_id = $link_request->user_id;
                    $link_request->accept();
                    $link_request->save();
                    $shop->save();
                    \DB::commit();
                    Mail::to($link_request->request_email)->send(new LinkRequestNotification($link_request->shop->shop_name, $link_request));
                } catch (\Exception $e) {
                    \DB::rollback();
                }
            } else if ($req->accept == 'reject') {
                $this->validate($req, [
                    'reason' => 'required'
                ]);
                $link_request->reason = $req->reason;
                $link_request->reject();
                $link_request->save();
                Mail::to($link_request->request_email)->send(new LinkRequestNotification($link_request->shop->shop_name, $link_request));
            }
        }

        return redirect('/home_admin');
    }
}
