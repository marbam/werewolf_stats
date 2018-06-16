<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new Carbon();
        $game = App\Game::create(['date_played' => $now]);
        
        $players[] = ['game_id' => $game->id,
                      'start_role' => 1,
                      'start_faction' => 1,
                      'end_role' => 1,
                      'end_faction' => 1,
                      'survived' => 1,
                      'victory' => 1
                    ];


        $players[] = ['game_id' => $game->id,
                      'start_role' => 6,
                      'start_faction' => 2,
                      'end_role' => 6,
                      'end_faction' => 2,
                      'survived' => 0,
                      'victory' => 0
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 15,
                      'start_faction' => 1,
                      'end_role' => 15,
                      'end_faction' => 1,
                      'survived' => 0,
                      'victory' => 1
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 17,
                      'start_faction' => 1,
                      'end_role' => 11,
                      'end_faction' => 1,
                      'survived' => 1,
                      'victory' => 1
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 11,
                      'start_faction' => 1,
                      'end_role' => 11,
                      'end_faction' => 1,
                      'survived' => 1,
                      'victory' => 1
                    ];

        App\Player::insert($players);

        // -------------------------------------------- //

        $game = App\Game::create(['date_played' => $now]);

        $players = array();

        $players[] = ['game_id' => $game->id,
                      'start_role' => 1,
                      'start_faction' => 1,
                      'end_role' => 1,
                      'end_faction' => 1,
                      'survived' => 0,
                      'victory' => 1
                    ];


        $players[] = ['game_id' => $game->id,
                      'start_role' => 2,
                      'start_faction' => 1,
                      'end_role' => 2,
                      'end_faction' => 1,
                      'survived' => 0,
                      'victory' => 1
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 3,
                      'start_faction' => 1,
                      'end_role' => 3,
                      'end_faction' => 1,
                      'survived' => 1,
                      'victory' => 1
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 4,
                      'start_faction' => 1,
                      'end_role' => 4,
                      'end_faction' => 1,
                      'survived' => 1,
                      'victory' => 1
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 5,
                      'start_faction' => 1,
                      'end_role' => 5,
                      'end_faction' => 1,
                      'survived' => 1,
                      'victory' => 1
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 6,
                      'start_faction' => 2,
                      'end_role' => 6,
                      'end_faction' => 2,
                      'survived' => 0,
                      'victory' => 1
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 7,
                      'start_faction' => 2,
                      'end_role' => 7,
                      'end_faction' => 2,
                      'survived' => 0,
                      'victory' => 0
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 8,
                      'start_faction' => 2,
                      'end_role' => 8,
                      'end_faction' => 2,
                      'survived' => 0,
                      'victory' => 0
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 9,
                      'start_faction' => 3,
                      'end_role' => 9,
                      'end_faction' => 3,
                      'survived' => 0,
                      'victory' => 0
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 10,
                      'start_faction' => 1,
                      'end_role' => 10,
                      'end_faction' => 1,
                      'survived' => 1,
                      'victory' => 1
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 11,
                      'start_faction' => 1,
                      'end_role' => 11,
                      'end_faction' => 1,
                      'survived' => 1,
                      'victory' => 1
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 12,
                      'start_faction' => 1,
                      'end_role' => 12,
                      'end_faction' => 1,
                      'survived' => 0,
                      'victory' => 0
                    ];

        $players[] = ['game_id' => $game->id,
                      'start_role' => 13,
                      'start_faction' => 1,
                      'end_role' => 13,
                      'end_faction' => 1,
                      'survived' => 1,
                      'victory' => 1
                    ];

        App\Player::insert($players);

    }
}
