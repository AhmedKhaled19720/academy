<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Model\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        $courses = CourseResource::collection(course::all());
        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $courses,
        ];
        return response()->json($data);
    }

    public function show_course($id)
    {
        $courses = course::find($id);
        if ($courses) {
            $data = [
                "msg" => "Return All Data",
                "status" => 200,
                "data" => new CourseResource($courses),
            ];
            return response()->json($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => 201,
                "data" => null,
            ];
            return response()->json($data);
        }
    }
    function delete_course(Request $requset)
    {
        $id = $requset->id;
        $courses = course::find($id);
        if ($courses) {
            if (File::exists(public_path('courses/img/' . $courses->course_img))) {
                File::delete(public_path('courses/img/' . $courses->course_img));
            }
            $courses->delete();
            $data = [
                "msg" => "Deleted Successfully",
                "status" => "200",
                "data" => null
            ];
            return response($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => "204",
                "data" => null
            ];
            return response($data);
        }
    }

    function create_course(Request $request)
    {

        $validateData = Validator($request->all(), [
            'id' => 'required|unique:courses|max:255',
            'name' => 'required',
            'course_img' => 'required|image',
        ]);

        if ($validateData->fails()) {

            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }
        if ($request->hasFile('course_img')) {
            $img = $request->course_img;
            $imgname = rand(1, 1000) . time() . "." . $img->extension();
            $img->move(public_path('courses/img/'), $imgname);
        }


        $newdata = course::create([
            'id' => $request->id,
            'name' => $request->name,
            'course_img' => $imgname,
            'course_title' => $request->course_title,
            'course_description' => $request->course_description,
            'category_id' => $request->category_id,
            'instructor_id' => $request->instructor_id,
            'lecture_no' => $request->lecture_no,
            'hours_no' => $request->hours_no,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'level' => $request->level,
            'status' => $request->status,
            'price' => $request->price,
        ]);
        $data = [
            'msg' => 'Create Successfully',
            'status' => '200',
            'data' => new CourseResource($newdata),
        ];
        return response($data);
    }

    public function update_course(Request $request)
    {

        $old_id = $request->old_id;
        $courses = course::find($old_id);

        $validateData = Validator($request->all(), [
            'id' =>  [
                'required',
                Rule::unique('courses')->ignore($old_id),
            ],
            'name' => 'required',
            'course_title' => 'required',
            'course_img' => 'image',
            'instructor_id' => 'required',
            'course_description' => 'required',
            'lecture_no' => 'required',
            'hours_no' => 'required',
            'start_date' => 'required',
            'duration' => 'required',
            'level' => 'required',
            'status' => 'required',
            'price' => 'required',

        ]);

        if ($validateData->fails()) {

            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }
        if (File::exists(public_path('courses/img/' . $courses->course_img))) {
            File::delete(public_path('courses/img/' . $courses->course_img));
        }
        if ($courses) {
            if ($request->hasFile('course_img')) {
                $img = $request->course_img;
                $imgname = rand(1, 1000) . time() . "." . $img->extension();
                $img->move(public_path('courses/img/'), $imgname);
            } else {
                $imgname = $courses->course_img;
            }
            $courses->update([
                'id' => $request->id,
                'name' => $request->name,
                'course_title' => $request->course_title,
                'course_img' => $imgname,
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

            $data = [
                "msg" => "Updated Successfully",
                "status" => 200,
                "data" => $courses
            ];
            return response($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => 203,
                "data" => $courses
            ];
            return response($data);
        }
    }

    public function getCoursesByCategory($categoryId)
    {
        // Fetch courses by category ID
        $courses = Course::where('category_id', $categoryId)
            ->select('id as course_id', 'course_title', 'course_img', 'course_description', 'category_id')
            ->get();

        // Prepare response data
        $data = $courses->map(function ($course) {
            return [
                'c_id' => $course->course_id,
                'c_title' => $course->course_title,
                'course_img' => $course->course_img,
                'course_description' => $course->course_description,
                'category_id' => $course->category_id,
            ];
        });

        // Prepare response
        $response = [
            "msg" => "Return User courses",
            "status" => 200,
            "data" => $data,
        ];

        return response()->json($response);
    }


    public function getCourseDetails($coursesId, $coursesTitle)
    {
        // Log a message to indicate that the function is being called
        Log::info('Fetching course details for coursesId: ' . $coursesId . ' and coursesTitle: ' . $coursesTitle);

        // Fetch course by ID and Title with join on categories and instructors tables
        $course = Course::where('courses.id', $coursesId)
            ->where('courses.course_title', $coursesTitle)
            ->join('categories', 'courses.category_id', '=', 'categories.id')
            ->join('instructors', 'courses.instructor_id', '=', 'instructors.id')
            ->select('courses.id as course_id', 'courses.course_title', 'courses.course_description', 'courses.course_img', 'courses.lecture_no', 'courses.hours_no', 'courses.price', 'courses.start_date', 'courses.duration', 'courses.level', 'courses.status', 'courses.category_id', 'categories.name as category_name', 'instructors.name as instructor_name', 'instructors.instructor_img', 'instructors.job', 'courses.instructor_id')
            ->first();

        if (!$course) {
            // Log a message to indicate that the course was not found
            Log::warning('Course not found for coursesId: ' . $coursesId . ' and coursesTitle: ' . $coursesTitle);

            return response()->json([
                "msg" => "Course not found",
                "status" => 404,
                "data" => null,
            ]);
        }

        // Log a message to indicate that the course details were successfully retrieved
        Log::info('Course details retrieved successfully for coursesId: ' . $coursesId . ' and coursesTitle: ' . $coursesTitle);

        // Prepare response data
        $data = [
            'courses_id' => $course->course_id,
            'courses_title' => $course->course_title,
            'course_description' => $course->course_description,
            'course_img' => $course->course_img,
            'lecture_no' => $course->lecture_no,
            'hours_no' => $course->hours_no,
            'price' => $course->price,
            'start_date' => $course->start_date,
            'duration' => $course->duration,
            'level' => $course->level,
            'status' => $course->status,
            'category_id' => $course->category_id,
            'category_name' => $course->category_name,
            'instructor_id' => $course->instructor_id,
            'instructor_name' => $course->instructor_name,
            'instructor_img' => $course->instructor_img,
            'job' => $course->job,
        ];

        // Prepare response
        $response = [
            "msg" => "Course details retrieved successfully",
            "status" => 200,
            "data" => $data,
        ];

        return response()->json($response);
    }
}
