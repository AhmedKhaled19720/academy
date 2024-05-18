<?php

namespace App\Http\Controllers;

use App\Model\assignment;
use App\Model\course;
use App\Model\instructor;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = course::all();
        $alldata = assignment::all();
    
        return view('assignments.view-assignments', compact('alldata', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(assignment $assignment)
    {
        //
    }
}
