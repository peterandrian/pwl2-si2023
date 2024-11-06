<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Get all user
     */
    public function index()
    {
        return User::all();
    }

    /**
     * get user by id
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!$user) return response()->json(['message' => 'User not found'], 404);
        return $user;
    }

    /**
     * Store new user
     */
    public function store(Request $request)
    {
        // validate request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        //hash password
        $validatedData['password'] = bcrypt($validatedData['password']);
        //create user
        $user = User::create($validatedData);
        //return response
        return response()->json($user, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user){
            return response()->json(['messages' => 'user not found'], 404);
        }
        //validate input
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        //hash password
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        //update user
        $user->update($validatedData);
        //return response
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);
        
        $user->delete();
        return response()->json(null, 200);
    }
}