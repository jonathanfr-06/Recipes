<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    public function index() { 
        
        $users = User::paginate(10);

        return UserResource::collection($users);
    }

    public function store(UserStoreRequest $request) {

        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
    
        // On crée un nouvel utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json($user, 201);
     }

    public function show(User $user) {
        return new UserResource($user);
     }

    public function update(UserStoreRequest $request, User $user) {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
    
        // On modifie les informations de l'utilisateur
        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);
    
        // On retourne la réponse JSON
        return response()->json();
     }

    public function destroy(User $user) {
        $user->delete();

        // On retourne la réponse JSON
        return response()->json();

     }
}