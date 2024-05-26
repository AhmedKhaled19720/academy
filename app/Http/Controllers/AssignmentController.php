<?php

namespace App\Http\Controllers;

use App\Model\assignment;
use App\Model\course;
use App\Model\instructor;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{

    public function index()
    {
        $courses = assignment::all();
        $assignments = assignment::all();

        return view('assignments.view-assignments', compact('assignments', 'courses'));
    }



    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);

        return view('assignments.crud.create', compact('course'));
    }

    public function store(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id);

        $request->validate([
            'ass_title' => 'required|string|max:255',
            'ass_description' => 'required|string',
            'ass_file' => 'nullable|file|mimes:pdf,doc,docx,txt,image',
            'deadline' => 'required|date',
            'notes' => 'nullable|string',
            'degree' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('ass_file')) {
            $file = $request->file('ass_file');
            $fileName = $request->ass_title . "_" . time() . "." . $file->extension();
            $file->storeAs('assignments', $fileName, 'public');
        } else {
            $fileName = null;
        }

        $assignment = new Assignment([
            'ass_title' => $request->input('ass_title'),
            'ass_description' => $request->input('ass_description'),
            'ass_file' => $fileName,
            'deadline' => $request->input('deadline'),
            'notes' => $request->input('notes'),
            'degree' => $request->input('degree'),
            'course_id' => $course->id,
        ]);

        $assignment->save();

        return redirect()->route('courses', ['course_id' => $course->id])->with('success', 'Assignment created successfully.');
    }


    public function show($course_id)
    {
        $assignments = Assignment::where('course_id', $course_id)->get();
        return view('assignments.crud.show', compact('assignments'));
    }
    public function show_one($id)
    {

        $assignment = assignment::findOrFail($id);

        return view('assignments.crud.view_one', compact('assignment'));
    }


    public function edit(assignment $assignment)
    {
        //
    }


    public function update(Request $request, assignment $assignment)
    {
        //
    }


    public function destroy($id)
    {
        $assignment = assignment::findOrFail($id);

        $assignment->delete();
        session()->flash('delete_assignment');
        return redirect()->route('courses');
    }
}
