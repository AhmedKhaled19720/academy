<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user-profile.profile-user');
    }

    public function edit()
    {
        $currentUser = Auth::user();
        return view('user-profile.crud.edit', ['currentUser' => $currentUser]);
    }

    public function save(Request $request)
    {
        $old_id = $request->input('old_id');
        $user = User::findOrFail($old_id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);
        session()->flash('updated');
        return redirect()->route('profile-user');
    }
}
