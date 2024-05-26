<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserloginRequest;
use App\Http\Requests\UserloginUpdateRequest;
use App\Model\userlogin;
use App\Notifications\sendemail;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserloginController extends Controller
{

    public function index()
    {
        $users = userlogin::all();
        return view('users.allusers', ['user' => $users]);
    }

    public function create()
    {
        return view('users.crud.create');
    }

    public function store(UserloginRequest $user)
    {
        userlogin::create([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'city' => $user->city,
            'role' => 'disactive',
            'password' => Hash::make($user['password']),
            'created_by' => (Auth::user()->name),
        ]);
        session()->flash('created');
        return redirect()->route('allusers');
    }

    public function show($id)
    {
        $users = userlogin::findOrFail($id);

        return view('users.crud.show', ['user' => $users]);
    }

    public function edit($id)
    {
        $users = userlogin::findOrFail($id);
        return view('users.crud.edit', ['user' => $users]);
    }

    public function save(UserloginUpdateRequest $request)
    {
        $old_id = $request->old_id;
        $user = Userlogin::findOrFail($old_id);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'role' => $request->role,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        Session()->flash('updated', 'User updated successfully!');
        return redirect()->route('allusers');
    }

    public function delete($id)
    {
        $users = userlogin::findOrFail($id);
        $users->delete();
        session()->flash('delete_user');
        return redirect()->route('allusers');
    }
}
