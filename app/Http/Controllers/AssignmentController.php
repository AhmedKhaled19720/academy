<?php

namespace App\Http\Controllers;

use App\Model\assignment;
use App\Model\course;
use App\Model\instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            'ass_file' => 'nullable|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png,gif',
            'deadline' => 'required|date',
            'notes' => 'nullable|string',
            'degree' => 'required|numeric|min:0',
        ], [
            'ass_title.required' => 'Please enter the assignment title.',
            'ass_title.string' => 'The assignment title must be a string.',
            'ass_title.max' => 'The assignment title may not be greater than 255 characters.',
            'ass_description.required' => 'Please enter the assignment description.',
            'ass_description.string' => 'The assignment description must be a string.',
            'ass_file.file' => 'The assignment file must be a file.',
            'ass_file.mimes' => 'The assignment file must be a file of type:pdf,doc,docx,txt,jpg,jpeg,png,gif.',
            'deadline.required' => 'Please enter the deadline for the assignment.',
            'deadline.date' => 'The deadline must be a valid date.',
            'notes.string' => 'The notes must be a string.',
            'degree.required' => 'Please enter the degree for the assignment.',
            'degree.numeric' => 'The degree must be a number.',
            'degree.min' => 'The degree must be at least 0.',
        ]);
    
        if ($request->hasFile('ass_file')) {
            $file = $request->ass_file;
            $filename = rand(1, 1000) . time() . "." . $file->extension();
            $file->move(public_path('assignments/files/'), $filename);
        } else {
            $filename = null;
        }
    
        $assignment = new Assignment([
            'ass_title' => $request->input('ass_title'),
            'ass_description' => $request->input('ass_description'),
            'ass_file' => $filename,
            'deadline' => $request->input('deadline'),
            'notes' => $request->input('notes'),
            'degree' => $request->input('degree'),
            'course_id' => $course->id,
        ]);
    
        $assignment->save();
        session()->flash('create');
    
        return redirect()->route('assignments.show', ['id' => $course->id]);
    }
    
    


    public function show($course_id)
    {
        $course = Course::findOrFail($course_id);
        $assignments = Assignment::where('course_id', $course_id)->get();
        return view('assignments.crud.show', compact('course', 'assignments'));
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

    public function update(Request $request, $courseId, $assignmentId)
    {
        $request->validate([
            'ass_title' => 'required|string',
            'ass_description' => 'nullable|string',
            'ass_file' => 'nullable|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png,gif',
            'deadline' => 'required|date',
            'degree' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ], [
            'ass_title.required' => 'Please enter the assignment title.',
            'ass_title.string' => 'The assignment title must be a string.',
            'ass_description.string' => 'The assignment description must be a string.',
            'ass_file.file' => 'The assignment file must be a file.',
            'ass_file.mimes' => 'The assignment file must be a file of type:pdf,doc,docx,txt,jpg,jpeg,png,gif.',
            'deadline.required' => 'Please enter the deadline for the assignment.',
            'deadline.date' => 'The deadline must be a valid date.',
            'degree.numeric' => 'The degree must be a number.',
        ]);
    
        $assignment = Assignment::find($assignmentId);
    
        if (!$assignment) {
            return redirect()->back()->with('error', 'Assignment not found.');
        }
    
        $course = Course::find($courseId);
    
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }
    
        if ($request->hasFile('ass_file')) {
            if (File::exists(public_path('assignments/files/' . $assignment->ass_file))) {
                File::delete(public_path('assignments/files/' . $assignment->ass_file));
            }
            $file = $request->ass_file;
            $filename = rand(1, 1000) . time() . "." . $file->extension();
            $file->move(public_path('assignments/files/'), $filename);
        } else {
            $filename = null;
        }
    
        $assignment->update([
            'ass_title' => $request->input('ass_title'),
            'ass_description' => $request->input('ass_description'),
            'deadline' => $request->input('deadline'),
            'degree' => $request->input('degree'),
            'notes' => $request->input('notes'),
            'course_id' => $course->id,
            'ass_file' => $filename,
        ]);
    
        session()->flash('update', 'Assignment updated successfully!');
        return redirect()->route('assignments.show', ['id' => $course->id]);
    }
    


    public function destroy($id)
    
    {
        $assignment = assignment::findOrFail($id);
        $course = Course::findOrFail( $assignment->course_id);
        if (File::exists(public_path('assignments/files/' . $assignment->ass_file))) {
            File::delete(public_path('assignments/files/' . $assignment->ass_file));
        }
        $assignment->delete();
        session()->flash('delete_assignment');
        return redirect()->route('assignments.show', ['id' => $course->id]);

    }
}