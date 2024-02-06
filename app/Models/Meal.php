<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Meal
 *
 * @property int $id
 * @property string $name
 * @property string $beschreibung
 * @property string $erfasst_am
 * @property int $vegetarisch
 * @property int $vegan
 * @property float $preisintern
 * @property float $preisextern
 * @property string|null $bildname
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereBeschreibung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereBildname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereErfasstAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal wherePreisextern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal wherePreisintern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereVegan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereVegetarisch($value)
 * @mixin \Eloquent
 */
class Meal extends Model
{
    use HasFactory;
    protected $table = 'gericht';
    protected $fillable = [
        'name',
        'beschreibung',
        'erfasst_am',
        'vegetarisch',
        'vegan',
        'preisintern',
        'preisextern',
        'bildname',
    ];
    public static function get_mealcount()
    {
        return Meal::count();
    }
    public function bewertung()
    {
        return $this->hasMany(Bewertung::class, 'gericht_id', 'id');
    }
    public function getPreisinternAttribute($value)
    {return number_format($value, 2);}
    public function setPreisinternAttribute($value)
    {$this->attributes['preisintern'] = round($value, 2);}
    public function getPreisexternAttribute($value)
    {return number_format($value, 2);}
    public function setPreisexternAttribute($value)
    {$this->attributes['preisextern'] = round($value, 2);}

    public function getVegetarischAttribute($value)
    {
        return $this->formatiereBoolWert($value);
    }
    public function setVegetarischAttribute($value)
    {
        $this->attributes['vegetarisch'] = $this->konvertiereZuBool($value);
    }
    public function getVeganAttribute($value)
    {
        return $this->formatiereBoolWert($value);
    }
    public function setVeganAttribute($value)
    {
        $this->attributes['vegan'] = $this->konvertiereZuBool($value);
    }
    private function formatiereBoolWert($value)
    {
        return $value ? 'Yes' : 'No';
    }
    private function konvertiereZuBool($value)
    {
        $value = str_replace(" ", "", $value);
        return in_array(strtolower(trim($value)), ['yes', 'ja']);
    }
}

