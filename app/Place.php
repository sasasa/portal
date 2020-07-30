<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Place
 *
 * @property int $id
 * @property string $prefecture
 * @property string $district
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place wherePrefecture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Place extends Model
{
    protected $fillable = [
        'prefecture',
        'district',
    ];
}
