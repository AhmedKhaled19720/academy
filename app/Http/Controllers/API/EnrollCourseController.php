<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Resources\AssignmentResource;
use App\Model\Assignment;
use App\Model\course;
use App\Model\enrollcourse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class EnrollCourseController extends Controller
{

    public function index()
    {
        $enrollments = EnrollCourse::with(['user:id,username,email', 'course:id,course_title,course_img'])->get();

        $data = $enrollments->map(function ($enrollment) {
            return [
                'user_email' => $enrollment->user->email,
                'course_title' => $enrollment->course->course_title,
                'course_id' => $enrollment->course->id,
                'course_img' => $enrollment->course->course_img,
                'subscription_status' => $enrollment->subscription_status,
            ];
        });

        $response = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $data,
        ];

        return response()->json($response);
    }

    public function getUserEnrollments($userId)
{
    // البحث عن تسجيلات المستخدم باستخدام معرف المستخدم المحدد
    $enrollments = EnrollCourse::where('user_id', $userId)
        ->with(['user:id,username,email', 'course:id,course_title,course_img'])
        ->get();

    // تهيئة البيانات بالشكل المطلوب
    $data = $enrollments->map(function ($enrollment) {
        return [
            'course_id' => $enrollment->course->id,
            'user_email' => $enrollment->user->email,
            'course_title' => $enrollment->course->course_title,
            'course_img' => $enrollment->course->course_img,
            'subscription_status' => $enrollment->subscription_status,
        ];
    });

    // تجهيز الرد
    $response = [
        "msg" => "Return User Enrollments",
        "status" => 200,
        "data" => $data,
    ];

    return response()->json($response);
}


public function getCourseAssignments($courseTitle)
{
    // التحقق من وجود الكورس
    $course = Course::where('course_title', $courseTitle)->first();

    if (!$course) {
        // إذا لم يتم العثور على الكورس، قم بإرجاع رسالة خطأ
        $data = [
            "msg" => "Course not found",
            "status" => 404,
            "data" => null,
        ];
        return response()->json($data);
    }

    // استعادة المهام المرتبطة بالكورس مع بيانات الكورس
    $assignments = $course->assignments()->with('course')->get();

    // تهيئة البيانات بالشكل المطلوب
    $data = $assignments->map(function ($assignment) {
        return [
            'assignment_id' => $assignment->id,
            'assignment_title' => $assignment->ass_title,
            'course_name' => $assignment->course->course_title, // استخدام اسم الكورس بدلاً من ID
            'deadline' => $assignment->deadline,
            'assignment_description' => $assignment->ass_description,
            'assignment_file' => $assignment->ass_file,
            'notes' => $assignment->notes,
            'degree' => $assignment->degree,
            // يمكنك إضافة المزيد من البيانات هنا إذا لزم الأمر
        ];
    });

    // تجهيز الرد
    $response = [
        "msg" => "Return Course Assignments",
        "status" => 200,
        "data" => $data,
    ];

    return response()->json($response);
}







}
