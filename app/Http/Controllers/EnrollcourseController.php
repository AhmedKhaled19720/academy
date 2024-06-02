<?php

namespace App\Http\Controllers;

use App\Model\course;
use App\Model\enrollcourse;
use App\Model\Userlogin;
use Illuminate\Http\Request;

class EnrollcourseController extends Controller
{

    public function index()
    {
        $users = Userlogin::where('role', 'active')->get();
        $alldata = enrollcourse::with(['user', 'course'])
        ->whereHas('user', function ($query) {
            $query->where('role', 'active');
        })
        ->get();
        $courses = course::all();
        
        return view('enrollCourses.enroll', compact('alldata', 'users', 'courses'));
        
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $messages = [
            'user_id.required' => 'You Should Select a Student From List',
            'user_id.unique' => 'Student is already Exsist in this course',
            'course_id.required' => 'You Should Select a Course From List'
        ];
        $request->validate([
            'user_id' => 'required|unique:enrollcourses,user_id,NULL,id,course_id,' . $request->course_id,
            'course_id' => 'required'
        ], $messages);

        EnrollCourse::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'registration_date' => now(),
            'subscription_status' => 'active'
        ]);

        return redirect()->route('enroll.index')
            ->with('success', 'User enrolled successfully.');
    }



    public function show(enrollcourse $enrollcourse)
    {
        //
    }


    public function edit(enrollcourse $enrollcourse)
    {
        //
    }

    public function update(Request $request, enrollcourse $enrollcourse)
    {
        //
    }

    public function destroy($id)
    {
        $item = enrollcourse::findOrFail($id);
        $item->delete();
    
        return redirect()->route('enroll.index')->with('success', 'Item deleted successfully');
    }
    


    public function toggleSubscription(Request $request, $id)
    {
        try {
            $course = EnrollCourse::findOrFail($id);
            $course->subscription_status = $request->input('subscription_status');
            $course->save();

            return response()->json(['status' => 'success', 'message' => 'Subscription status updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to update subscription status.'], 500);
        }
    }
}