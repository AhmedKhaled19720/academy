<?php

namespace App\Http\Controllers;

use App\Model\InstructorRequest;

class InstructorRequestController extends Controller
{
    public function index()
    {
        $instructors = InstructorRequest::all();
        return view('instructors.allinstructors', ['instructor' => $instructors]);
    }

    public function delete($id)
    {
        $instructors = InstructorRequest::findOrFail($id);
        $instructors->delete();
        session()->flash('delete_request');
        return redirect()->route('allinstructors');
    }
}
