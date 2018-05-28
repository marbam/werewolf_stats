<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Faction;
use App\Http\Controllers\Controller;

class FactionController extends Controller
{
    public function listing()
    {
        $factions = Faction::pluck('faction_name', 'id');
        return view('factions.listing', ['factions' => $factions]);
    }

    public function show()
    {
        dd("Faction breakdown to go here once I've figured out what I want to display!");
    }
}
