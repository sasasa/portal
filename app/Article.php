<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Article
 *
 * @property int $id
 * @property string $article_title
 * @property string $article_path
 * @property string $article_content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereArticleContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereArticlePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereArticleTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
