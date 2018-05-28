<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'game_id',
        'start_role',
        'start_faction',
        'end_role',
        'end_faction',
        'survived',
        'victory',
    ];

    protected $dates = [
        'date_played',
        'created_at',
        'updated_at',
    ];
}
