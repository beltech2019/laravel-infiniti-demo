<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{

    use HasFactory, SoftDeletes;


    protected $table = 'tb_language';

    protected $casts = [
        'publish' => 'integer',
    ];

    protected $fillable = [
        'name',
        'code',
        'publish',
    ];
}
