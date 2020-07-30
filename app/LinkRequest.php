<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LinkRequest
 *
 * @property int $id
 * @property int $user_id
 * @property int $shop_id
 * @property string $request_name
 * @property string $request_email
 * @property string $request_tel
 * @property string $request_address
 * @property string $license_path
 * @property int $accept_flg
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Shop $shop
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereAcceptFlg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereLicensePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereRequestAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereRequestEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereRequestName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereRequestTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\LinkRequest whereUserId($value)
 * @mixin \Eloquent
 */
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
