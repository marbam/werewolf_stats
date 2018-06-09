<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function listing()
    {
        $id = Auth::id();
        $users = User::where('id', '!=', $id)->get();
        return view('users.listing', ['users' => $users]);
    }

    public function approve(Request $request)
    {
        $user = User::findOrFail($request['user_id']);
        $user->approved = 1;
        $user->save();
    }

    public function revoke(Request $request)
    {
        $user = User::findOrFail($request['user_id']);
        $user->approved = 0;
        $user->save();
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request['user_id']);
        $user->delete();
    }
}
