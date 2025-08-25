<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SlotGames extends Model
{
    use SoftDeletes;

    protected $table = 'tb_slot_games_list';

    protected $fillable = [
        'gameName', 'gameNumber', 'gameCategory', 'currencyCode',
        'windowHeight', 'windowWidth', 'gameImageLocations', 'gamePrice',
        'gameDescription', 'background', 'published', 'merchant_code',
        'prizeSchemeIge', 'extraParams', 'ordering', 'portal_bg', 'engineType'
    ];
}