<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create() 
    {
        return view('sessions.create');
    }

    public function store() 
    {
        $attributes = request()->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(auth()->attempt($attributes)) {
            session()->regenerate(); // against session fixation

            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'error' =>'User doesn\'t exists or password is wrong'
        ]);
    }

    public function destroy() 
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
