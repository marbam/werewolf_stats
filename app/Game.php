<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'date_played',
    ];

    protected $dates = [
        'date_played',
        'created_at',
        'updated_at',
    ];

    public function players()
    {
        return $this->hasMany('App\Player', 'game_id', 'id');
    }
}
