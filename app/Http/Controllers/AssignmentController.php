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
            'ass_file' => 'nullable|file|mimes:pdf,doc,docx,txt,image',
            'deadline' => 'required|date',
            'notes' => 'nullable|string',
            'degree' => 'required|numeric|min:0',
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

        return redirect()->route('courses', ['course_id' => $course->id]);
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
            'deadline' => 'required|date',
            'degree' => 'nullable|numeric',
            'notes' => 'nullable|string',
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
            if ($request->hasFile('ass_file')) {
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
            ]);
            session()->flash('update', 'Assignment updated successfully!');
            return redirect()->route('assignments.show', ['id' => $assignmentId]);
        }
    }


    public function destroy($id)
    {
        $assignment = assignment::findOrFail($id);
        if (File::exists(public_path('assignments/files/' . $assignment->ass_file))) {
            File::delete(public_path('assignments/files/' . $assignment->ass_file));
        }
        $assignment->delete();
        session()->flash('delete_assignment');
        route('assignments.show', ['id' => $assignment->id]);
    }
}
