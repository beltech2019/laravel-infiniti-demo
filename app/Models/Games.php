<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Games extends Model
{

    use HasFactory, SoftDeletes;


    protected $table = 'tb_games';

    protected $casts = [
        'publish' => 'integer',
    ];

    protected $fillable = [
        'name',
        'publish',
    ];
}
