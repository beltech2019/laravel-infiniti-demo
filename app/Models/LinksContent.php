<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LinksContent extends Model
{
    use HasFactory;

    protected $table = 'links_content';

    protected $fillable = [
        'key',
        'value',
        'lang',
        'data',
    ];
}
