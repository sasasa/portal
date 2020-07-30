<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationsController extends Controller
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
    public function store(Request $req)
    {
        if ( Auth::user()->is_shop_subscription_user() || Auth::user()->role == 'user' ) {
            $this->validate($req, \App\Evaluation::$rules);
            $evaluation = new \App\Evaluation();
            $evaluation->fill($req->all());
            $evaluation->user_id = Auth::user()->id;
            $evaluation->save();

            if ( $req->prefecture ) {
                return redirect(route('shop', [
                    'prefecture' => $req->prefecture,
                    'district' => $req->district,
                    'id' => $req->shop_id
                ]));
            } else {
                return redirect(route('shops.show', [
                    'shop' => $req->shop_id
                ]));
            }
        } else if ( Auth::user()->role == 'shop' ) {
            return redirect('/shops/publicity');
        }

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
    public function destroy(Request $req, \App\Evaluation $evaluation)
    {
        $evaluation->delete();

        if ( $req->prefecture ) {
            return redirect(route('shop', [
                'prefecture' => $req->prefecture,
                'district' => $req->district,
                'id' => $evaluation->shop_id
            ]));
        } else {
            return redirect(route('shops.show', [
                'shop' => $evaluation->shop_id
            ]));
        }
    }
}
