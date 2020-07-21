<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public static $rules = [
        'blog_title' => 'required|max:60',
        // 'blog_path' => 'required',
        'blog_content' => 'required|min:10',
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
        'blog_title',
        'blog_content',
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
