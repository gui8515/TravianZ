<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Get all users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // get a user
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    // Create a new user
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
    }

    // Delete a user
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    // Get all users with villages
    public function getUsersWithVillages()
    {
        $user = User::with('villages')->get();
        return response()->json($user);
    }

    // Get all users with villages with fields
    public function getUsersWithFields()
    {
        $user = User::with('villages', 'villages.Fields')->get();
        return response()->json($user);
    }

    // Get all users with villages with units
    public function getUsersWithUnits()
    {
        $user = User::with('villages', 'villages.units')->get();
        return response()->json($user);
    }

    // Show user with villages
    public function showUserWithVillages($id)
    {
        $user = User::with('villages')->find($id);
        return response()->json($user);
    }

    // Show user with villages with fields
    public function showUserWithFields($id)
    {
        $user = User::with('villages', 'villages.fields')->find($id);
        return response()->json($user);
    }

    // Show user with villages with units
    public function showUserWithUnits($id)
    {
        $user = User::with('vilages', 'villages.units')->find($id);
        return response()->json($user);
    }
}
