<?php

namespace App\Http\Controllers;

use App\Model\InstructorRequest;
use Illuminate\Support\Facades\File;

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
}
