<?php

namespace App\Http\Controllers;

use App\Http\Requests\instructorRequest as RequestsInstructorRequest;
use App\Model\category;
use App\Model\contactUs;
use App\Model\course;
use App\Model\instructor;
use App\Model\InstructorRequest;
use App\Model\userlogin;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $users = UserLogin::all();
        $instructors = instructor::all();
        $courses=course::all();
        $contactUs=contactUs::where('role', 0)->get();
     $instructorRequests=InstructorRequest::where('role', 0)->get();   

        return view('home', [
            'category' => $categories,
            'user' => $users,
            'instructor' => $instructors,
            'course' => $courses,
            'contactUs'=>$contactUs,
            'insrtuctorRequest'=>$instructorRequests
        ]);
    }
}