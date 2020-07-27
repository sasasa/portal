<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkRequest extends Model
{

    public static $rules = [
        'request_name' => 'required|max:60',
        'request_email' => 'required|max:60',
        'request_tel' => 'required|max:60',
        'request_address' => 'required|max:60',
            // アップロードしたファイルのバリデーション設定
        'upfile' => [
            'required',
            'file',
            'image',
            'mimes:jpeg,png',
            'dimensions:min_width=100,min_height=100,max_width=900,max_height=900',
        ],
    ];

    protected $fillable = [
        'request_name',
        'request_email',
        'request_tel',
        'request_address',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
}
