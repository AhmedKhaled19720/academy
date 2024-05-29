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
        $alldata = enrollcourse::with(['user', 'course'])->get();
        $users = Userlogin::all();
        $courses = course::all();
        return view('enrollCourses.enroll', compact('alldata', 'users', 'courses'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'course_id' => 'required'
        ]);

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


    public function destroy(enrollcourse $id)
    {
        $item = enrollcourse::findOrFail($id);
        $item->delete();

        return redirect()->route('enroll.index')->with('success', 'Item deleted successfully');
    }


    public function toggleSubscription(Request $request, $id)
    {
        try {
            $id = EnrollCourse::findOrFail($id);
            $id->subscription_status = $request->input('subscription_status');
            $id->save();

            return response()->json(['status' => 'success', 'message' => 'Subscription status updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to update subscription status.'], 500);
        }
    }
}