<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Session
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Session newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Session newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Session query()
 * @mixin \Eloquent
 */
class Session extends Model
{
    public static function get_visitercount()
    {
        return DB::table('besucher')->count();
    }
    public static function get_userrcount()
    {
        return DB::table('benutzer')->count();
    }
}
