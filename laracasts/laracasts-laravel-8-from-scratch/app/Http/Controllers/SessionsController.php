<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    //
    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($attributes)) {
            session()->regenerate();

            return redirect('/')->with('success', 'Welcome Back!');
        }

//        Esta forma es igual que la de abajo con throw ValidationException
//        return back()
//            ->withInput()
//            ->withErrors(['email'=>'Your provided credentials could not be verified']);

        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified.'
        ]);
    }

    //Logout, destruir la sesión
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
