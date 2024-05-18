<?php

namespace App\Http\Controllers;

use App\Http\Requests\courseRequest;
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
            $imageName = "defult-img.jpg";
            $validatedData['course_img'] = $imageName;
        }

        // if ($request->hasFile('cate_image')) {
        //     if (File::exists(public_path('categories/img/' . $categories->cate_image))) {
        //         File::delete(public_path('categories/img/' . $categories->cate_image));
        //     }



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


    public function update(Request $request, course $course)
    {
        // Retrieve the old ID from the request
        $old_id = $request->old_id;

        // Find the course by its ID
        $course = Course::findOrFail($old_id);

        $imageName = $course->course_img ?? 'default-img.jpg';

        if ($request->hasFile("course_img")) {
            // Check if there is an existing image and delete it
            if ($course->course_img && $course->course_img !== 'default-img.jpg') {
                $existingImagePath = "storage/courses/img/" . $course->course_img;
                if (Storage::exists($existingImagePath)) {
                    Storage::delete($existingImagePath);
                }
            }

            // Store the new image file
            $image = $request->file("course_img");
            $imageName = rand(1, 1000) . time() . "." . $image->extension();
            $image->storeAs("storage/courses/img/", $imageName);

            // Update the validated data with the new image filename
            $validatedData['course_img'] = $imageName;
        } else {
            // Ensure the validated data contains the existing or default image name
            $validatedData['course_img'] = $imageName;
        }


        // Update the course with the new information from the request
        $course->update(array_merge($validatedData, [
            "id" => $request->id,
            "course_title" => $request->course_title,
            "category_id" => $request->category_id,
            "instructor_id" => $request->instructor_id,
            "course_description" => $request->course_description,
            "lecture_no" => $request->lecture_no,
            "hours_no" => $request->hours_no,
            "start_date" => $request->start_date,
            "duration" => $request->duration,
            "level" => $request->level,
            "status" => $request->status,
            "price" => $request->price,
        ]));

        session()->flash('update');

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
}
