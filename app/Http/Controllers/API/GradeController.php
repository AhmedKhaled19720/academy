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
    public function showStudents($assignmentId)
    {
        // اكتشاف الواجب
        $assignment = assignment::findOrFail($assignmentId);
        $courseId = $assignment->course_id;

        // جلب الطلاب المسجلين في الدورة
        $students = Userlogin::whereHas('courses', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->get();

        // اكتشاف الدورة
        $course = course::findOrFail($courseId);

        // جلب درجة المهمة من جدول الواجب
        $taskDegree = $assignment->degree;

        // جلب اسم الدورة
        $courseName = $course->course_title;

        // جلب اسم الواجب
        $assignmentName = $assignment->ass_title;

        // إرجاع البيانات كـ JSON
        return response()->json([
            'students' => $students,
            'assignment_id' => $assignmentId,
            'course_id' => $courseId,
            'course' => $course,
            'assignment' => $assignment,
            'task_degree' => $taskDegree,
            'course_name' => $courseName,
            'assignment_name' => $assignmentName
        ], 200);
    }

    public function store_grad(Request $request)
{
    $validator = Validator::make($request->all(), [
        'assignment_id' => 'required|exists:assignments,id',
        'course_id' => 'required|exists:courses,id',
        // 'course_title' => 'required|exists:courses,course_title',
        'user_id' => 'required|exists:userlogins,id',
        'grade' => 'required|numeric|min:0',
    ]);

    if ($validator->fails()) {
        $data = [
            'msg' => 'No Valid Data',
            'status' => 203,
            'data' => $validator->errors(),
        ];
        return response()->json($data);
    }

    $assignment = assignment::findOrFail($request->input('assignment_id'));
    $maxGrade = $assignment->degree;

    if ($request->input('grade') > $maxGrade) {
        $data = [
            'msg' => 'Grade exceeds maximum allowed',
            'status' => 203,
        ];
        return response()->json($data);
    }

    $newdata = Grade::updateOrCreate(
        ['user_id' => $request->input('user_id'), 'assignment_id' => $request->input('assignment_id'), 'course_id' => $request->input('course_id'),'course_id' => $request->input('course_id')],
        ['grade' => $request->input('grade')]
    );

    $data = [
        'msg' => 'Grade stored successfully',
        'status' => 200,
        'data' => new GradeResource($newdata),
    ];
    return response()->json($data);
}

    public function showAllStudentsWithGrades($assignmentId)
    {
        // اكتشاف الواجب
        $assignment = Assignment::findOrFail($assignmentId);

        // الوصول إلى درجة الواجب
        $assignmentDegree = $assignment->degree;

        // جلب جميع الطلاب مع الدرجات للواجب
        $studentsWithGrades = UserLogin::whereHas('grades', function ($query) use ($assignmentId) {
            $query->where('assignment_id', $assignmentId);
        })->with(['grades' => function ($query) use ($assignmentId) {
            $query->where('assignment_id', $assignmentId);
        }])->get();

        // اكتشاف الدورة
        $course = Course::findOrFail($assignment->course_id);

        // إرجاع البيانات كـ JSON
        return response()->json([
            'students_with_grades' => $studentsWithGrades,
            'assignment' => $assignment,
            'course' => $course,
            'assignment_degree' => $assignmentDegree
        ], 200);
    }

    public function update_grad(Request $request, Grade $grade)
    {
        $assignmentId = $grade->assignment_id;
        $assignment = Assignment::findOrFail($assignmentId);
        $maxGrade = $assignment->degree;

        $request->validate([
            'grade' => [
                'required',
                'numeric',
                'min:0',
                "max:$maxGrade",
            ],
        ]);

        $grade->update([
            'grade' => $request->grade,
        ]);

        // إرجاع استجابة بنجاح
        return response()->json(['message' => 'Grade updated successfully'], 200);
    }

    public function showOneStudentGrades($userId)
    {
        $user = Userlogin::with('enrolledCourses', 'assignments')->findOrFail($userId);

        $totalGrade = $user->assignments->sum(function ($assignment) {
            return $assignment->pivot->grade;
        });

        $course_title = $user->enrolledCourses->pluck('course_title')->first();

        // إرجاع البيانات كـ JSON
        return response()->json([
            'user' => $user,
            'total_grade' => $totalGrade,
            'course_title' => $course_title
        ], 200);
    }
}

