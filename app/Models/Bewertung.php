<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bewertung extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'bewertung';
    protected $fillable = [
        'id',
        'user_id',
        'gericht_id',
        'bewertung',
        'sterne_bewertung',
        'adminapproved',
        'erfasst_am',
    ];
    public static function createBewertung($data)
    {
        return self::create([
            'user_id' => $data['user_id'],
            'gericht_id' => $data['gericht_id'],
            'bewertung' => $data['bewertung'],
            'sterne_bewertung' => $data['sterne_bewertung'],
            'adminapproved' => $data['adminapproved'],
            'erfasst_am' => now(),
        ]);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function meal()
    {
        return $this->belongsTo(Meal::class, 'gericht_id', 'id');
    }

}
