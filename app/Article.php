<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public static $rules = [
        'article_title' => 'required|max:60',
        'article_content' => 'required|min:10',
            // アップロードしたファイルのバリデーション設定
        'upfile' => [
            'required',
            'file',
            'image',
            'mimes:jpeg,png',
            'dimensions:min_width=100,min_height=100,max_width=900,max_height=900',
        ],
    ];

    public static $update_rules = [
        'article_title' => 'required|max:60',
        'article_content' => 'required|min:10',
    ];

    protected $fillable = [
        'article_title',
        'article_content',
    ];
}
