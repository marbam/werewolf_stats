<?php

namespace App\Http\Controllers;

// use App\User;
use DB;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function insert()
    {
    	$roles = DB::table('roles')->pluck('role_name', 'id');
    	$factions = DB::table('factions')->pluck('faction_name', 'id');
        return view('game.insert', ['roles' => $roles, 'factions' => $factions]);
    }

    public function append()
    {
    	$roles = DB::table('roles')->pluck('role_name', 'id');
    	$factions = DB::table('factions')->pluck('faction_name', 'id');
    	return view('game.insert_row', ['roles' => $roles, 'factions' => $factions]);
    }
}