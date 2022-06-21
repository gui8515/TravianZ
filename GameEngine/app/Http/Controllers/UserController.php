<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }


    public function show(User $user)
    {
        // return response()->json($user);
        return env('APP_NAME');
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
