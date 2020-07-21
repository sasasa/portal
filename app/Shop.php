<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
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
}
