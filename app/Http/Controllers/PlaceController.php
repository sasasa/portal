<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('place.index', [
            'places' => \App\Place::paginate(10)
        ]);
    }

    public function json_districts($prefecture)
    {
        return response()->json([
            'places' => \App\Place::where('prefecture', $prefecture)->pluck("district")
        ]);
    }

    public function districts($prefecture)
    {
        return view('place.districts', [
            'prefecture' => $prefecture,
            'places' => \App\Place::where('prefecture', $prefecture)->paginate(10)
        ]);
    }

    public function shops($prefecture, $district)
    {
        $uniq_shops = \App\Shop::select('shops.*')
                    ->leftJoin('users', 'shops.user_id', '=', 'users.id')
                    ->where('shops.location', 'like', $prefecture. $district. '%')
                    ->orderBy('users.is_subscription', 'DESC')
                    ->orderBy('shops.blog_id', 'DESC')->paginate(10);

        return view('place.shops', [
            'prefecture' => $prefecture,
            'district' => $district,
            // 'shops' => \App\Shop::where('location', 'like', $prefecture. $district. '%')->paginate(10),

            'shops' => $uniq_shops
        ]);
    }

    public function shop($prefecture, $district, int $id)
    {
        return view('place.shop', [
            'prefecture' => $prefecture,
            'district' => $district,
            'shop' => \App\Shop::find($id)
        ]);
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
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
