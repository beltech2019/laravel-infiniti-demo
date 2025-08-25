<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameArt extends Model
{
    use SoftDeletes;

    protected $table = 'tb_gameart_list';

    protected $fillable = [
        'gameName', 'gameId', 'thumbnail'
    ];
}
