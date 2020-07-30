<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Shop
 *
 * @property int $id
 * @property string $shop_name
 * @property string $location
 * @property string $phone_number
 * @property string|null $shop_mail
 * @property string|null $url
 * @property string|null $description
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Blog[] $blogs
 * @property-read int|null $blogs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Evaluation[] $evaluations
 * @property-read int|null $evaluations_count
 * @property-read \App\LinkRequest|null $link_request
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop whereShopMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $blog_id 最新ブログのID
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shop whereBlogId($value)
 */
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
    public function save_latest_blog_id()
    {
        $this->blog_id = $this->blogs()->pluck('id')->max();
        $this->save();
    }
}
