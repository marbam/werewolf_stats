<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Faction;
use App\Game;
use App\Http\Controllers\Controller;

class FactionController extends Controller
{
    public function listing()
    {
        $factions = Faction::pluck('faction_name', 'id');
        return view('factions.listing', ['factions' => $factions]);
    }

    public function show($id)
    {
        $games = Game::join('players', 'games.id', '=', 'players.game_id')
                     ->join('factions', 'players.start_faction', '=', 'factions.id')
                     ->where('factions.id', $id)
                     ->orderBy('date_played', 'ASC')
                     ->get([
                        'games.id',
                        'games.date_played',
                        'survived',
                        'victory',
                        'faction_name'
                     ]);

        $faction_name = Faction::where('id', $id)->first()->faction_name;

        $occurances = $games->count();
        if ($occurances) {
            $victories = $games->where('victory', 1)->count();
            $losses = $occurances-$victories;

            $survival = $games->where('survived', 1)->count();
            $deaths = $occurances-$survival;
            $pie_data = [$victories, $losses, $survival, $deaths];
        } else {
            return view('factions.no_games', ['faction' => $faction_name]);
        }

        $occurance_cumulative = [];
        $occurance_by_date = [];
        $wins_by_week = [];
        $loss_by_week = [];
        $index = 0;
        $occurance_total = 0;
        $last_played = '';

        foreach ($games as $game) {
            $occurance_total++;
            if ($game->date_played->format('d/m/Y') == $last_played) { // same date
                $occurance_cumulative[$index] = [$game->date_played, $occurance_total];
                $occurance_by_date[$index][1]++;
                $game->victory ? $wins_by_week[$index][1]++ : $loss_by_week[$index][1]++;
            } else { // different date
                $index++;
                $last_played = $game->date_played->format('d/m/Y');
                $occurance_cumulative[$index] = [$game->date_played, $occurance_total];
                $occurance_by_date[$index] = [$game->date_played, 1];
                if ($game->victory) {
                    $wins_by_week[$index] = [$game->date_played, 1];
                    $loss_by_week[$index] = [$game->date_played, 0];
                } else {
                    $wins_by_week[$index] = [$game->date_played, 0];
                    $loss_by_week[$index] = [$game->date_played, 1];
                }
            }
        }

        $data = [
            'played_cumulative' => $occurance_cumulative,
            'played_by_date' => $occurance_by_date,
            'victories' => $victories,
            'losses' => $losses,
            'wins_by_week' => $wins_by_week,
            'loss_by_week' => $loss_by_week,
            'faction' => $faction_name,
        ];

        return view('factions.show', $data);
    }
}
