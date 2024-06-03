<?php

namespace App\Http\Controllers;

use App\Model\InstructorRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class InstructorRequestController extends Controller
{
    public function index()
    {
        $instructors = InstructorRequest::all();
        return view('instructorsRequests.allinstructors', ['instructor' => $instructors]);
    }

    public function delete($id)
    {
        $instructors = InstructorRequest::findOrFail($id);
        if (File::exists(public_path('instructorsRequests/cv/' . $instructors->cv))) {
            File::delete(public_path('instructorsRequests/cv/' . $instructors->cv));
        }
        $instructors->delete();
        session()->flash('delete_request');
        return redirect()->route('allinstructors');
    }
    public function changeRoleTo0(Request $request)
    {
        $userId = $request->userId;
    
        $user = InstructorRequest::find($userId);
    
        if ($user) {
            $user->role = 0;
            $user->save();
        }
    
        return redirect()->route('allinstructors');
    }
    
    public function changeRoleTo1(Request $request)
    {
        $userId = $request->userId;
    
        $user = InstructorRequest::find($userId);
    
        if ($user) {
            $user->role = 1;
            $user->save();
        }
    
        return redirect()->route('allinstructors');
    }
    

    
}