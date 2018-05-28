<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function listing()
    {
        $roles = Role::pluck('role_name', 'id');
        return view('roles.listing', ['roles' => $roles]);
    }

    public function show()
    {
        dd("Role breakdown to go here once I've figured out what I want to display!");
    }
}
