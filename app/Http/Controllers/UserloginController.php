<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserloginRequest;
use App\Http\Requests\UserloginUpdateRequest;
use App\Model\userlogin;
use App\Notifications\sendemail;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class UserloginController extends Controller
{

    public function index()
    {
        $users = userlogin::all();
        return view('user.alluser', ['user' => $users]);
    }

    public function create()
    {
        return view('user.crud.create');
    }

    public function store(UserloginRequest $user)
    {
        userlogin::create([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password,
            'created_by' => (Auth::user()->name),
        ]);

        return redirect()->route('alluser')->with('message', 'created successfully');
    }

    public function show($id)
    {
        $users = userlogin::findOrFail($id);

        return view('user.crud.show', ['user' => $users]);
    }

    public function edit($id)
    {
        $users = userlogin::findOrFail($id);
        return view('user.crud.edit', ['user' => $users]);
    }

    public function save(UserloginUpdateRequest $user)
    {
        $old_id = $user->old_id;
        $users = userlogin::findOrFail($old_id);

        $users->update([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password,
            'confirm_pass' => $user->confirm_pass,
        ]);

        return redirect()->route('alluser')->with('message', 'updated successfully');
    }

    public function delete($id)
    {
        $users = userlogin::findOrFail($id);
        $users->delete();
        session()->flash('delete_user');
        return redirect()->route('alluser');
    }
}
