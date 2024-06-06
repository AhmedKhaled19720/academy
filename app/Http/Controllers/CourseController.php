<?php

namespace App\Http\Controllers;

use App\Http\Requests\courseRequest;
use App\Http\Requests\courseUpdateRequest;
use App\Model\category;
use App\Model\course;
use App\Model\instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{

    public function index()
    {
        $categories = category::all();
        $instructors = instructor::all();
        $courses = Course::with(['instructor', 'category', 'students'])->get();

        $alldata = Course::with(['instructor', 'category'])->get();
        return view('courses.view-courses', compact('alldata', 'categories', 'instructors'));
    }


    public function create()
    {
        $categories = category::all();
        $instructors = instructor::all();
        return view('courses.crud.create', compact('categories', 'instructors'));
    }


    public function store(CourseRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile("course_img")) {
            $image = $request->course_img;
            $imageName = rand(1, 1000) . time() . "." . $image->extension();
            $image->move(public_path('courses/img/'), $imageName);

            $validatedData['course_img'] = $imageName;
        } else {
            $imageName = "default-img.jpg";
            $validatedData['course_img'] = $imageName;
        }
        $course = new Course();
        $course->fill($validatedData);
        $course->save();
        session()->flash('create');

        return redirect()->route('courses');
    }
    public function show($id)
    {
        $course = Course::findOrFail($id);
        $categories = category::all();
        $instructors = instructor::all();
        return view('courses.crud.show', compact('course', 'categories', 'instructors'));
    }


    public function edit($id)
    {

        $course = Course::findOrFail($id);
        $categories = category::all();
        $instructors = instructor::all();
        return view('courses.crud.edit', compact('course', 'categories', 'instructors'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // Handle image upload
        $imageName = $course->course_img;
        if ($request->hasFile('course_img')) {
            $image = $request->file('course_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('courses/img/'), $imageName);

            // Delete old image if it exists
            if ($course->course_img !== "default-img.jpg" && $course->course_img !== $imageName) {
                $existingImagePath = public_path('courses/img/') . $course->course_img;
                if (File::exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
            }
        }

        // Update course details
        $course->update([
            'course_img' => $imageName,
            'course_title' => $request->course_title,
            'category_id' => $request->category_id,
            'instructor_id' => $request->instructor_id,
            'course_description' => $request->course_description,
            'lecture_no' => $request->lecture_no,
            'hours_no' => $request->hours_no,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'level' => $request->level,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        session()->flash('update', 'Course updated successfully!');
        return redirect()->route('courses');
    }

    public function destroy($id)
    {

        $course = Course::findOrFail($id);
        if ($course->course_img != "defult-img.jpg") {
            if (File::exists(public_path('courses/img/' . $course->course_img))) {
                File::delete(public_path('courses/img/' . $course->course_img));
            }
        }
        $course->delete();
        session()->flash('delete_courses');
        return redirect()->route('courses');
    }

    public function showStudents($id)
    {
        $course = Course::with('students')->findOrFail($id);

        return view('student-assignment.students', ['course' => $course]);
    }
    
}