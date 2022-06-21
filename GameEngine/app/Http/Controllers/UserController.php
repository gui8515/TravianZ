<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
    }


    public function destroy(User $user)
    {
    }


    public function getUsersWithVillages()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->villages = $user->villages()->get();
        }
        return $users;
    }
}
