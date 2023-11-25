<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        User::create($request->validated() + ['password' => 'password']);

        return redirect()->route('dashboard');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard');
    }
}
