<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Allergen
 *
 * @property string $code
 * @property string $name
 * @property string $typ
 * @method static \Illuminate\Database\Eloquent\Builder|Allergen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Allergen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Allergen query()
 * @method static \Illuminate\Database\Eloquent\Builder|Allergen whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allergen whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allergen whereTyp($value)
 * @mixin \Eloquent
 */
class Allergen extends Model
{
    use HasFactory;
    protected $table = 'allergen';
    protected $fillable = [
        'code',
        'name',
        'typ',
    ];
}
