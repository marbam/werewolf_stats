<?php

namespace App\Http\Controllers;

use DB;
use \App\Game;
use Carbon\Carbon;
use \App\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function insert()
    {
        $data = $this->getDetails();
        $today = date("Y-m-d");
        return view('game.insert', ['today' => $today, 'roles' => $data['roles'], 'factions' => $data['factions']]);
    }

    public function append()
    {
        $data = $this->getDetails();
        return view('game.insert_row', ['roles' => $data['roles'], 'factions' => $data['factions']]);
    }

    public function store(Request $request)
    {

        $request->validate(['date_played' => 'required']);
        $game = Game::create(['date_played' => $request['date_played']]);

        $player_count = count($request['players']['start_role']);
        $players = $request['players'];

        for ($p = 0; $p <= $player_count-1; $p++) {
            Player::insert([
                'game_id' => $game->id,
                'start_role' => $players['start_role'][$p],
                'start_faction' => $players['start_faction'][$p],
                'end_role' => $players['end_role'][$p],
                'end_faction' => $players['end_faction'][$p],
                'survived' => $players['survived'][$p],
                'victory' => $players['victory'][$p]
            ]);
        }

        return view('game.inserted', ['game' => $game]);
    }

    public function getDetails()
    {
        $data['roles'] = DB::table('roles')->pluck('role_name', 'id');
        $data['factions'] = DB::table('factions')->pluck('faction_name', 'id');
        return $data;
    }

    public function getFaction(Request $request)
    {
        $roles = DB::table('roles')->pluck('starting_faction', 'id');
        return $roles[$request["role"]];
    }

    public function list()
    {
        $games = Game::with('players')->orderBy('date_played')->get();
        return view('game.listing', ['games' => $games]);
    }

    public function show(Game $game)
    {
        $players = Player::where('game_id', $game->id)->get();
        $role_factions = $this->getDetails();
        $roles = $role_factions['roles'];
        $factions = $role_factions['factions'];
        return view('game.show', ['game' => $game, 'players' => $players, 'roles' => $roles, 'factions' => $factions]);
    }
}
