<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role_name',
        'starting_faction',
        'mystic',
        'corrupt',
    ];

    public function players()
    {
        return $this->hasMany('App\Player', 'start_role', 'id');
    }
}
