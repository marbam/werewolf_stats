<?php

namespace App\Http\Controllers;

use DB;
use Response;
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

    public function deletePlayer(Request $request)
    {
        $player = Player::where('id', $request->player_id)->first();
        $game_id = $player->game_id;
        $deleted = $player->delete();
        if ($deleted) {
            $player_count = Player::where('game_id', $game_id)->count();
            if ($player_count) {
                return "deleted";
            } else {
                Game::where('id', $game_id)->delete();
                return "last_one";
            }
        }
    }

    public function editPlayer(Request $request)
    {
        $r = $request->all();
        $player = Player::where('id', $r['id'])->first();
        $player->start_role = $r['start_role'];
        $player->start_faction = $r['start_faction'];
        $player->end_role = $r['end_role'];
        $player->end_faction = $r['end_faction'];
        $player->survived = $r['survived'];
        $player->victory = $r['victory'];
        $updated = $player->save();
        if ($updated) {
            return "updated";
        }
        return "failed";
    }

    public function export()
    {
        $games = Game::with(['players'])->get();

        $output = '';
        foreach ($games as $game) {
            $output.= "Game,".$game->date_played."\n";
            foreach ($game->players as $player) {
                $output.=   "Player,".
                            $game->id.','.
                            $player->start_role.','.
                            $player->start_faction.','.
                            $player->end_role.','.
                            $player->end_faction.','.
                            $player->survived.','.
                            $player->victory.
                            "\n";
            }
        }

        $headers = array(
          'Content-Type' => 'text/csv',
          'Content-Disposition' => 'attachment; filename="werewolf_games_export_'.date("Y-m-d-H-i-s").'.csv"',
        );

        return Response::make($output, 200, $headers);
    }

    public function import()
    {
        return view('game.import');
    }

    public function processImport(Request $request)
    {
        Game::truncate();
        Player::truncate();

        $file = public_path('/import.csv');
        if (!file_exists($file) || !is_readable($file)) {
            dd("File not present or invalid");
        }

        $data = array();
        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }

        $game_id = '';
        foreach ($data as $csv_row) {
            if ($csv_row[0] == "Game") {
                $game = Game::create(['date_played' => $csv_row[1]]);
                $game_id = $game->id;
            } else { // player
                Player::create([
                    'game_id' => $game_id,
                    'start_role' => $csv_row[2],
                    'start_faction' => $csv_row[3],
                    'end_role' => $csv_row[4],
                    'end_faction' => $csv_row[5],
                    'survived' => $csv_row[6],
                    'victory' => $csv_row[7]
                ]);
            }
        }

        return redirect('/list');
    }
}
