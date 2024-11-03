<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'login' => 'required|string|max:255|unique:users,login',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'phone.unique' => 'Номер телефона уже зарегистрирован',
            'login.unique' => 'Логин занят',
        ]);
    
        User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'phone' => $request->phone,
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('login')->with('status', 'Регистрация успешна!');
    }
    
}

