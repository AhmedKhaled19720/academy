<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GradeResource;
use App\Model\assignment;
use App\Model\course;
use App\Model\Grade;
use App\Model\Userlogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GradeController extends Controller
{
    //show all students degree to specific assignment
    // public function showStudents($assignmentId)
    // {
    //     $assignment = Assignment::findOrFail($assignmentId);
    //     $course = $assignment->course;

    //     // Get students enrolled in the course
    //     $students = UserLogin::whereHas('enrolledCourses', function ($query) use ($course) {
    //         $query->where('course_id', $course->id);
    //     })->get();

    //     // Prepare the custom data
    //     $customData = $students->map(function ($student) use ($assignment, $course) {
    //         $grade = $student->grades()->where('assignment_id', $assignment->id)->first();
    //         return [

    //             'user_name' => $student->username,
    //             'email' => $student->email,
    //             'user_grade' => $grade ? $grade->grade : 'N/A',

    //         ];

    //     });

    //     return response()->json([
    //         'assignment_name' => $assignment->ass_title,
    //         'assignment_degree' => $assignment->degree,
    //         'course_name' => $course->course_title,
    //         "data" => $customData,
    //     ], 200);
    // }

    // public function showAllStudentsWithGrades($courseId)
    // {
    //     // Find the course
    //     $course = Course::findOrFail($courseId);

    //     // Get all assignments for the course
    //     $assignments = Assignment::where('course_id', $courseId)->get();

    //     // Get all students enrolled in the course
    //     $students = UserLogin::whereHas('enrolledCourses', function ($query) use ($courseId) {
    //         $query->where('course_id', $courseId);
    //     })->get();

    //     // Prepare the data
    //     $studentsWithGrades = $students->map(function ($student) use ($assignments) {
    //         $grades = $assignments->map(function ($assignment) use ($student) {
    //             $grade = $student->grades()->where('assignment_id', $assignment->id)->first();
    //             return [
    //                 'assignment_name' => $assignment->ass_title,
    //                 'assignment_degree' => $assignment->degree,
    //                 'user_grade' => $grade ? $grade->grade : 'N/A',
    //             ];
    //         });

    //         return [
    //             'user_name' => $student->username,
    //             'email' => $student->email,
    //             'grades' => $grades,
    //         ];
    //     });

    //     return response()->json([
    //         'course' => $course->course_title,
    //         'course_instructor' => $course->instructor->name,
    //         'students_with_grades' => $studentsWithGrades,

    //     ], 200);
    // }

    public function showOneStudentGrades($userId, $courseId)
    {
        try {
            // Fetch user with assignments and grades for the specified course
            $user = Userlogin::with(['assignments' => function ($query) use ($courseId) {
                $query->where('assignments.course_id', $courseId); // تحديد الجدول باستخدام assignments.course_id
            }])->findOrFail($userId);

            // Prepare response data
            $data = $user->assignments->map(function ($assignment) {
                return [
                    'assignmentTitle' => $assignment->ass_title,
                    'grade' => $assignment->pivot->grade,
                ];
            });

            // Return as JSON response
            return response()->json([
                'msg' => 'Return Student Assignment Grades for Course ' . $courseId,
                'status' => 200,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
