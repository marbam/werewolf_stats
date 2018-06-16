<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Role;
use App\Game;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function listing()
    {
        $roles = Role::pluck('role_name', 'id');
        return view('roles.listing', ['roles' => $roles]);
    }

    public function show($id)
    {
        $games = Game::join('players', 'games.id', '=', 'players.game_id')
                     ->join('roles', 'players.start_role', '=', 'roles.id')
                     ->where('roles.id', $id)
                     ->orderBy('date_played', 'ASC')
                     ->get([
                        'games.id',
                        'games.date_played',
                        'survived',
                        'victory'
                     ]);

        $role_name = Role::where('id', $id)->first()->role_name;

        $occurances = $games->count();
        if ($occurances) {
            $victories = $games->where('victory', 1)->count();
            $losses = $occurances-$victories;

            $survival = $games->where('survived', 1)->count();
            $deaths = $occurances-$survival;
            $pie_data = [$victories, $losses, $survival, $deaths];
        } else {
            return view('roles.no_games', ['role' => $role_name]);
        }

        $line_array = [];
        $count = 0;
        $last_played = '';
        $played_count = 0;
        $win_count = 0;
        $loss_count = 0;
        $alive_count = 0;
        $dead_count = 0;
        foreach ($games as $game) {
            $played_count++;
            $game->victory ? $win_count++ : $loss_count++;
            $game->survied ? $alive_count++ : $dead_count++;
            if ($game->date_played->format('d/m/Y') == $last_played) {
                $line_array[$count][1] = $played_count;
                $line_array[$count][2] = $win_count;
                $line_array[$count][3] = $loss_count;
                $line_array[$count][4] = $alive_count;
                $line_array[$count][5] = $dead_count;
            } else {
                $count++;
                $last_played = $game->date_played->format('d/m/Y');
                $line_array[$count] = [
                    $game->date_played,
                    $played_count,
                    $win_count,
                    $loss_count,
                    $alive_count,
                    $dead_count
                ];
            }
        }


        return view('roles.show', ['graph_data' => $line_array,
                                   'pie_data' => $pie_data,
                                   'role' => $role_name,
                                   'games' => $games
                               ]);
    }
}
