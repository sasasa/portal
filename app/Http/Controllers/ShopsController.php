<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LinkRequestNotification;

class ShopsController extends Controller
{

    public function index(Request $req)
    {
        $shop_query = \App\Shop::query();

        if ($req->shop_name) {
            $shop_query->where('shop_name', 'LIKE', "%".$req->shop_name."%");
        }
        if ($req->location) {
            $shop_query->where('location', 'LIKE', "%".$req->location."%");
        }
        if ($req->phone_number) {
            $shop_query->where('phone_number', 'LIKE', "%".$req->phone_number."%");
        }
        if ($req->shop_mail) {
            $shop_query->where('shop_mail', 'LIKE', "%".$req->shop_mail."%");
        }
        if ($req->user_name) {
            $shop_query->whereHas('user', function($q) use($req){
                $q->where('name', 'LIKE', "%".$req->user_name."%");
            });
        }
        if ($req->user_email) {
            $shop_query->whereHas('user', function($q) use($req){
                $q->where('email', 'LIKE', "%".$req->email."%");
            });
        }
        $shops = $shop_query->orderBy('created_at', 'desc')->paginate(10);

        return view('shops.index', [
            'shops' => $shops,
            'shop_name' => $req->shop_name,
            'location' => $req->location,
            'phone_number' => $req->phone_number,
            'shop_mail' => $req->shop_mail,
            'user_name' => $req->user_name,
            'user_email' => $req->user_email,
        ]);
    }

    public function create(Request $req)
    {
        return view('shops.create', [
        ]);
    }

    public function store(Request $req)
    {
        // ログインユーザが店舗の管理ユーザの時のみブログを作成可能
        $this->validate($req, \App\Shop::$create_rules);
        $shop = new \App\Shop();
        $shop->fillWithLocation($req);
        if (Auth::user() && Auth::user()->role == "shop") {
            $shop->user_id = Auth::user()->id;
        }
        $shop->save();
        return redirect('/shops/'. $shop->id);
    }

    public function show(\App\Shop $shop)
    {
        return view('shops.show', [
            'shop' => $shop
        ]);
    }

    public function edit(\App\Shop $shop)
    {
        if ((Auth::user()->id == $shop->user_id ) ||
            (Auth::user() && Auth::user()->role == 'admin')) {
            // 店舗に紐づいているか管理者の場合
            if ((Auth::user()->is_shop_subscription_user())||
                (Auth::user() && Auth::user()->role == 'admin')) {
                // 有料ユーザーか管理者の場合
                return view('shops.edit', [
                    'shop' => $shop
                ]);
            } else if ( Auth::user()->role == 'shop' ) {
                // 有料ユーザーでない場合
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

    public function update(Request $req, \App\Shop $shop)
    {
        // 店舗に紐づいたユーザーで有料ユーザーの時 と 管理者ユーザーの時
        if ((Auth::user()->id == $shop->user_id && Auth::user()->is_shop_subscription_user()) ||
            (Auth::user() && Auth::user()->role == 'admin')) {
            $this->validate($req, \App\Shop::$rules);
            $shop->fill($req->all())->save();
            return redirect('/shops/'. $shop->id);
        }
    }

    public function destroy(\App\Shop $shop)
    {
        $shop->delete();

        return back();
    }

    public function connect(\App\LinkRequest $link_request)
    {
        return view('shops.connect', [
            'shop' => $link_request->shop,
            'user' => $link_request->user,
            'link_request' => $link_request,
        ]);
    }

    public function linkage(Request $req, \App\LinkRequest $link_request)
    {
        // 申し込んできたユーザーが店舗ユーザーならば
        if (\App\User::find($link_request->user_id)->role == "shop") {
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
