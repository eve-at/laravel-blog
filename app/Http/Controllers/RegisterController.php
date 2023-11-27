<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name'     => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'min:8', Rule::unique('users', 'username')], // in case if field name differs from the column name
            'email'    => ['required', 'email', 'max:255', 'unique:users'], // in case if field name match the column name
            'password' => ['required', 'min:7'],
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Your account has been created');
    }
}
