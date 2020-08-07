<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
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
    public function create(\App\Shop $shop)
    {
        if (Auth::user()->id == $shop->user_id) {
            if ( Auth::user()->is_shop_subscription_user() ) {
                return view('blogs.create', [
                    'shop' => $shop
                ]);
            } else if ( Auth::user()->role == 'shop' ) {
                return view('shops.publicity', [
                    'shop' => $shop
                ]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Shop $shop, Request $req)
    {
        // ログインユーザが店舗の管理ユーザ時で
        // 有料ユーザー時のみブログを作成可能
        if (Auth::user()->id == $shop->user_id && Auth::user()->is_shop_subscription_user() ) {
            $this->validate($req, \App\Blog::$rules);
            \DB::beginTransaction();
            try {
                $file = $req->upfile;
                $file_name = basename($file->store('public'));
                $blog = new \App\Blog();
                $blog->fill($req->all());
                $blog->user_id = Auth::user()->id;
                $blog->shop_id = $shop->id;
                $blog->blog_path = $file_name;
                $blog->save();
                $shop->blog_id = $blog->id;
                $shop->save();
                \DB::commit();

                return redirect('/shops/'. $shop->id. '/blogs/'. $blog->id);
            } catch (\Exception $e) {
                \DB::rollback();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Shop $shop, \App\Blog $blog)
    {
        return view('blogs.show', [
            'shop' => $shop,
            'blog' => $blog,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Shop $shop, \App\Blog $blog)
    {
        \DB::beginTransaction();
        try {
            Storage::disk('public')->delete($blog->blog_path);
            $blog->delete();
            $shop->save_latest_blog_id();
            \DB::commit();

            return redirect('/shops/'. $shop->id);
        } catch (\Exception $e) {
            \DB::rollback();
        }
    }
}
