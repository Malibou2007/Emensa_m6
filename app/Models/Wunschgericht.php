<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Wunschgericht
 *
 * @property string $name
 * @property string $beschreibung
 * @property string $erfasst_am
 * @property string $autor
 * @property string $autormail
 * @method static \Illuminate\Database\Eloquent\Builder|Wunschgericht newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wunschgericht newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wunschgericht query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wunschgericht whereAutor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wunschgericht whereAutormail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wunschgericht whereBeschreibung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wunschgericht whereErfasstAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wunschgericht whereName($value)
 * @mixin \Eloquent
 */
class Wunschgericht extends Model
{
    protected $table = 'wunschgericht';
    public $timestamps = false;


    protected $fillable = [
        'name',
        'beschreibung',
        'erfasst_am',
        'autor',
        'autormail',
    ];

    public static function createWunschgericht($data)
    {
        return self::create([
            'name' => $data['name'],
            'beschreibung' => $data['beschreibung'],
            'erfasst_am' => now(),
            'autor' => $data['autor'],
            'autormail' => $data['autormail'],
        ]);
    }

}
