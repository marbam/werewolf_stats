<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$factions = [];
    	$factions[] = ["faction_name" => "Village"];
    	$factions[] = ["faction_name" => "Wolf Pack"];
    	$factions[] = ["faction_name" => "Defector"];
    	$factions[] = ["faction_name" => "Jester"];
    	$factions[] = ["faction_name" => "Madman"];
    	$factions[] = ["faction_name" => "Lovers - Juliet"];
    	$factions[] = ["faction_name" => "Lovers - Guardian Angel"];
    	$factions[] = ["faction_name" => "Criminals"];
    	$factions[] = ["faction_name" => "City"];
    	$factions[] = ["faction_name" => "Vampire"];
    	$factions[] = ["faction_name" => "Igor"];

    	DB::table('factions')->insert($factions);

    	$factions = DB::table('factions')->pluck('id', 'faction_name');

    	$roles = [];
    	$roles[] = ['role_name' => 'Clairvoyant', 'starting_faction' => $factions["Village"], 'mystic' => 1];
    	$roles[] = ['role_name' => 'Wizard', 'starting_faction' => $factions["Village"], 'mystic' => 1];
    	$roles[] = ['role_name' => 'Witch', 'starting_faction' => $factions["Village"], 'mystic' => 1];
    	$roles[] = ['role_name' => 'Medium', 'starting_faction' => $factions["Village"], 'mystic' => 1];
    	$roles[] = ['role_name' => 'Healer', 'starting_faction' => $factions["Village"], 'mystic' => 1];

    	$roles[] = ['role_name' => 'Alpha Wolf', 'starting_faction' => $factions["Wolf Pack"], 'corrupt' => 1];
    	$roles[] = ['role_name' => 'Pack Wolf', 'starting_faction' => $factions["Wolf Pack"], 'corrupt' => 1];
    	$roles[] = ['role_name' => 'Wolf Pup', 'starting_faction' => $factions["Wolf Pack"], 'corrupt' => 1];
    	$roles[] = ['role_name' => 'Defector', 'starting_faction' => $factions["Defector"]];
    	
    	$roles[] = ['role_name' => 'Monk', 'starting_faction' => $factions["Village"]];
    	$roles[] = ['role_name' => 'Priest', 'starting_faction' => $factions["Village"]];
    	$roles[] = ['role_name' => 'Sinner', 'starting_faction' => $factions["Village"], 'corrupt' => 1];
    	$roles[] = ['role_name' => 'Farmer (1)', 'starting_faction' => $factions["Village"]];
    	$roles[] = ['role_name' => 'Farmer (2)', 'starting_faction' => $factions["Village"]];
    	$roles[] = ['role_name' => 'Innkeeper', 'starting_faction' => $factions["Village"]];
    	$roles[] = ['role_name' => 'Bard', 'starting_faction' => $factions["Village"]];

    	$roles[] = ['role_name' => 'Jester', 'starting_faction' => $factions["Jester"]];
    	$roles[] = ['role_name' => 'Madman', 'starting_faction' => $factions["Madman"]];
    	
    	$roles[] = ['role_name' => 'Juliet', 'starting_faction' => $factions[ "Lovers - Juliet"]];
    	$roles[] = ['role_name' => 'Madman', 'starting_faction' => $factions["Lovers - Guardian Angel"]];

    	// can't do this en mass as Eloquent expects everything to have the same number of, and same arguments.
    	foreach($roles as $role) {
    		DB::table('roles')->insert($role);
    	}

    }
}
