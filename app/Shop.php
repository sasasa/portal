<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public static $create_rules = [
        'shop_name' => 'required|max:100',
        'prefecture' => 'required',
        'district' => 'required',
        'location' => 'required|max:125',
        'phone_number' => 'required',
        'shop_mail' => 'nullable|email',
        'url' => 'nullable|url',
        'description' => 'nullable|min:10',
    ];

    public static $rules = [
        'shop_name' => 'required|max:100',
        'location' => 'required|max:125',
        'phone_number' => 'required',
        'shop_mail' => 'nullable|email',
        'url' => 'nullable|url',
        'description' => 'nullable|min:10',
    ];
    protected $fillable = [
        'shop_name',
        'location',
        'phone_number',
        'shop_mail',
        'url',
        'description',
    ];

    public function evaluations()
    {
        return $this->hasMany('App\Evaluation');
    }
    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function link_request()
    {
        return $this->hasOne('App\LinkRequest');
    }
    public function fillWithLocation($req)
    {
        $this->fill($req->all());
        $this->location = $req->prefecture. $req->district. $this->location;
    }
}
