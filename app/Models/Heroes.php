<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Heroes extends Model
{
    use HasFactory;

    public static function getHeroes()
    {
        $heroes = collect(['status' => 'ok']);
        return $heroes;
    }

    public static function getHash($time)
    {
        $hash = md5($time.env('MARVEL_PRIVATE_KEY').env('MARVEL_PUBLIC_KEY'));
        return $hash;
    }
}
