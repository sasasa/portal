<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Evaluation
 *
 * @property int $id
 * @property int $user_id
 * @property int $shop_id
 * @property string $word_of_mouth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $format_date
 * @property-read \App\Shop $shop
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Evaluation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Evaluation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Evaluation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Evaluation whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Evaluation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Evaluation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Evaluation whereWordOfMouth($value)
 * @mixin \Eloquent
 */
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
