<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Blog
 *
 * @property int $id
 * @property int $user_id
 * @property int $shop_id
 * @property string $blog_title
 * @property string $blog_path
 * @property string $blog_content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Shop $shop
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereBlogContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereBlogPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereBlogTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Blog whereUserId($value)
 * @mixin \Eloquent
 */
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
