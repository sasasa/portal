<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopUsersController extends Controller
{
    public function index(Request $req)
    {
        $user_query = \App\User::query();
        $user_query->where('role', 'shop');

        if ($req->name) {
            $user_query->where('name', 'LIKE', "%".$req->name."%");
        }
        if ($req->email) {
            $user_query->where('email', 'LIKE', "%".$req->email."%");
        }

        return view('shop_users.index', [
            'shop_users' => $user_query->orderBy('id', 'desc')->paginate(10),
            'name' => $req->name,
            'email' => $req->email,
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
