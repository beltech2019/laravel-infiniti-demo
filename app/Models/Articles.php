<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{

    use HasFactory, SoftDeletes;


    protected $table = 'tb_articles';

    protected $fillable = [
        'name',
        'publish',
    ];
}
