<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MealAllergen
 *
 * @property string|null $code
 * @property int $gericht_id
 * @method static \Illuminate\Database\Eloquent\Builder|MealAllergen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MealAllergen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MealAllergen query()
 * @method static \Illuminate\Database\Eloquent\Builder|MealAllergen whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealAllergen whereGerichtId($value)
 * @mixin \Eloquent
 */
class MealAllergen extends Model
{
    use HasFactory;
    protected $table = 'gericht_hat_allergen';
    protected $fillable = [
        'code',
        'gericht_id',
    ];
}
