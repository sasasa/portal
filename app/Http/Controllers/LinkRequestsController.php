<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LinkRequestsController extends Controller
{
    public function index()
    {
        //
    }

    public function create(\App\Shop $shop)
    {
        return view('link_requests.create', [
            'shop' => $shop
        ]);
    }


    public function store(Request $req, \App\Shop $shop)
    {
        $this->validate($req, \App\LinkRequest::$rules);
        $file = $req->upfile;
        $file_name = basename($file->store('public'));

        $link_request = new \App\LinkRequest();
        $link_request->fill($req->all());
        $link_request->user_id = Auth::user()->id;
        $link_request->shop_id = $shop->id;
        $link_request->license_path = $file_name;
        $link_request->save();
        return redirect('/shops/'. $shop->id. '/link_requests/'. $link_request->id);
    }

    public function show(\App\Shop $shop, \App\LinkRequest $link_request)
    {
        // 自身の時もしくは管理者のみ申請状況を見れる
        if( $link_request->user_id == Auth::user()->id || Auth::user()->role == 'admin' ) {
            return view('link_requests.show', [
                'shop' => $shop,
                'link_request' => $link_request,
            ]);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
