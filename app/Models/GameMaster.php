<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameMaster extends Model
{
    protected $table = 'stpl_game_master';

    // If the table doesn't have timestamps
    public $timestamps = false;
}
