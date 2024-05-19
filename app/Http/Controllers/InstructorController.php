<?php

namespace App\Http\Controllers;

use App\Http\Requests\instructorRequest;
use App\Http\Requests\instructorUpdateRequest;
use App\Model\instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = instructor::all();
        return view('instructors.view-instructors', ['instructor' => $instructors]);
    }


    public function create()
    {
        return view('instructors.crud.create');
    }

    public function save(instructorRequest $request)
    {
        $imageName = "";
        if (request()->hasFile("instructor_img")) {
            $image = request()->file("instructor_img");
            $imageName = rand(1, 1000) . time() . "." . $image->extension();
            $image->move(public_path("instructors/img/"), $imageName);
        }

        instructor::create([
            'id' => $request->id,
            "instructor_img" => $imageName,
            'name' => $request->name,
            'password' => $request->password,
            'email' => $request->email,
            'job' => $request->job,
            'description' => $request->description,
            'instructor_facebook' => $request->instructor_facebook,
            'instructor_linkedin' => $request->instructor_linkedin,
            'instructor_insta' => $request->instructor_insta,
            'instructor_twitter' => $request->instructor_twitter,
        ]);

        session()->flash('create');
        return redirect()->route('instructors');
    }

    public function show($id)
    {
        $instructors = instructor::findOrFail($id);

        return view('instructors.crud.show', ['instructor' => $instructors]);
    }

    public function delete($id)
    {
        $instructors = instructor::findOrFail($id);
        if (File::exists(public_path('instructors/img/' . $instructors->instructor_img))) {
            File::delete(public_path('instructors/img/' . $instructors->instructor_img));
        }
        $instructors->delete();
        session()->flash('delete_instructor');
        return redirect()->route('instructors');
    }

    public function edit($id)
    {
        $instructors = instructor::findOrFail($id);
        return view('instructors.crud.edit', ['instructor' => $instructors]);
    }

    public function saveupdate(instructorUpdateRequest $request)
    {
        $old_id = $request->old_id;
        $instructor = instructor::findOrFail($old_id);

        // Handle image upload
        $imageName = $instructor->instructor_img;
        if ($request->hasFile('instructor_img')) {
            $image = $request->file('instructor_img');
            $imageName = rand(1, 1000) . time() . '.' . $image->extension();
            $image->move(public_path('instructors/img/'), $imageName);

            // Delete old image if it exists
            if (File::exists(public_path('instructors/img/' . $instructor->instructor_img))) {
                File::delete(public_path('instructors/img/' . $instructor->instructor_img));
            }
        }

        // Update instructor details
        $instructor->update([
            'id' => $request->id,
            'instructor_img' => $imageName,
            'name' => $request->name,
            'email' => $request->email,
            'job' => $request->job,
            'description' => $request->description,
            'instructor_facebook' => $request->instructor_facebook,
            'instructor_linkedin' => $request->instructor_linkedin,
            'instructor_insta' => $request->instructor_insta,
            'instructor_twitter' => $request->instructor_twitter,
        ]);

        session()->flash('update', 'Instructor updated successfully!');
        return redirect()->route('instructors');
    }
}
