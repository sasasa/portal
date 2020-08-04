<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
    ];

    protected $fillable = [
        'word_of_mouth',
        'shop_id',
        'parent_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function parent()
    {
        return $this->belongsTo('App\Evaluation', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Evaluation', 'parent_id');
    }

    public function getFormatDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('Y年m月d日 H時i分');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($evaluation) {
            $evaluation->children()->delete();
        });
    }
}
