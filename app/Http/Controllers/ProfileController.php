<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Валидируем и обновляем данные
        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $user->update($validatedData);

        return redirect()->route('profile/profile.show')->with('status', 'Данные успешно обновлены');
    }
}
