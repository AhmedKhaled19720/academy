<?php

namespace App\Http\Controllers;

use App\Model\contactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $alldata = contactUs::all();
        return view("contactUs.contactUs", compact("alldata"));
    }

    public function delete($id)
    {
        $alldata = contactUs::findOrFail($id);
        $alldata->delete();
        session()->flash('delete_contact');
        return redirect()->route('contactUs');
    }
    public function changeRoleTo0(Request $request)
    {
        $userId = $request->userId;
    
        $user = contactUs::find($userId);
    
        if ($user) {
            $user->role = 0;
            $user->save();
        }
    
        return redirect()->route('contactUs');
    }
    
    public function changeRoleTo1(Request $request)
    {
        $userId = $request->userId;
    
        $user = contactUs::find($userId);
    
        if ($user) {
            $user->role = 1;
            $user->save();
        }
    
        return redirect()->route('contactUs');
    }
}