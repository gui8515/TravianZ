<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    // Get all users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Get user
    public function show(User $user)
    {
        return response()->json($user);
    }

    /* Show user
    / @param $id
    */
    public function store(Request $request)
    {        $user = User::create($request->all());







        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    // Get all users with their villages
    public function getUsersWithVillages()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->villages = $user->villages()->get();
        }
        return $users;
    }
}
