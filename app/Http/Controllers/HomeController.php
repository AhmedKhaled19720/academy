<?php

namespace App\Http\Controllers;

use App\Model\category;
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
        $instructors = InstructorRequest::all();
        $allinstructors = instructor::all();

        return view('home', [
            'category' => $categories,
            'user' => $users,
            'instructor' => $instructors ,
            'allinstructors' => $allinstructors
        ]);
    }
}
