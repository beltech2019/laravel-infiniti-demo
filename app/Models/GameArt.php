<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameArt extends Model
{
    protected $table = 'stpl_gameart_info';

    // If the table doesn't have timestamps
    public $timestamps = false;
}
