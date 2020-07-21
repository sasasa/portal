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
        return view('blogs.create', [
            'shop' => $shop
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Shop $shop, Request $req)
    {

        $this->validate($req, \App\Blog::$rules);
        $file = $req->upfile;
        $file_name = basename($file->store('public'));

        $blog = new \App\Blog();
        $blog->fill($req->all());
        $blog->user_id = Auth::user()->id;
        $blog->shop_id = $shop->id;
        $blog->blog_path = $file_name;
        $blog->save();
        return redirect('/shops/'. $shop->id. '/blogs/'. $blog->id);
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
        Storage::disk('public')->delete($blog->blog_path);
        $blog->delete();
        return redirect('/shops/'. $shop->id);
    }
}
