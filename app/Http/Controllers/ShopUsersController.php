<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopUsersController extends Controller
{
    public function index()
    {
        return view('shop_users.index', [
            'shop_users' => \App\User::where('role', 'shop')->paginate(10)
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $req, \App\User $shop_user)
    {
        $shop_user->is_subscription = !$shop_user->is_subscription;
        $shop_user->save();
        return redirect('/shop_users');
    }

    public function destroy($id)
    {
        //
    }
}
