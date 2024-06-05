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

        session()->flash('enrolled');
        return redirect()->route('enroll.index');
    }

    public function destroy($id)
    {
        $item = enrollcourse::findOrFail($id);
        $item->delete();
        session()->flash('deleted');
        return redirect()->route('enroll.index');
    }

    public function toggleSubscription(Request $request, $id)
    {
        $enrollment = EnrollCourse::find($id);
        if (!$enrollment) {
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        $newStatus = $request->input('subscription_status');
        $enrollment->subscription_status = $newStatus;
        $enrollment->save();

        return response()->json(['message' => 'Subscription status updated successfully']);
    }
}
