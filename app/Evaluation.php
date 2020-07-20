<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public static $rules = [
        'word_of_mouth' => 'required|max:100',
        // 'shop_id' => 'required|integer',
        // 'user_id' => 'required|integer',
    ];

    protected $fillable = [
        'word_of_mouth',
        'shop_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    function getFormatDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y年m月d日 H-i-s') : null;
    }
}
