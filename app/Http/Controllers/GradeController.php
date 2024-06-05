<?php

namespace App\Http\Controllers;

use App\Model\assignment;
use App\Model\course;
use App\Model\Grade;
use App\Model\Userlogin;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function showStudents($assignmentId)
    {
        // Find the assignment
        $assignment = Assignment::findOrFail($assignmentId);
        $courseId = $assignment->course_id;

        // Fetch students enrolled in the course
        $students = UserLogin::whereHas('courses', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->get();

        // Find the course
        $course = Course::findOrFail($courseId);

        // Get task degree from assignment table
        $taskDegree = $assignment->degree;

        // Get course name
        $courseName = $course->course_title;

        // Get assignment name
        $assignmentName = $assignment->ass_title;

        // Pass all variables to the view
        return view('student-assignment.stu_degree', compact('students', 'assignmentId', 'courseId', 'course', 'assignment', 'taskDegree', 'courseName', 'assignmentName'));
    }

    public function store(Request $request)
    {
        $messages = [
            'user_id.required' => 'You should select a student from the list.',
            'user_id.unique' => 'Student is already exist in this course.',
            'grade.required' => 'Please enter the grade.',
            'grade.numeric' => 'Grade must be a number.',
            'grade.min' => 'Grade must be at least 0.',
        ];

        $assignmentId = $request->input('assignment_id');
        $courseId = $request->input('course_id');
        $studentId = $request->input('user_id');
        $gradeValue = $request->input('grade');

        $maxGrade = Assignment::findOrFail($assignmentId)->degree;

        $request->validate([
            'user_id' => 'required|unique:grades,user_id,NULL,id,assignment_id,' . $assignmentId . ',course_id,' . $courseId,
            'grade' => "required|numeric|min:0|max:$maxGrade"
        ],$messages);

        Grade::updateOrCreate(
            ['user_id' => $studentId, 'assignment_id' => $assignmentId, 'course_id' => $courseId],
            ['grade' => $gradeValue]
        );

        session()->flash('create');
        return redirect()->route('assignments.students', ['assignment' => $assignmentId]);
    }

    public function showAllStudentsWithGrades($assignmentId)
    {
        // Find the assignment
        $assignment = Assignment::findOrFail($assignmentId);

        // Access the assignment degree
        $assignmentDegree = $assignment->degree;

        // Fetch all students with grades for the assignment
        $studentsWithGrades = UserLogin::whereHas('grades', function ($query) use ($assignmentId) {
            $query->where('assignment_id', $assignmentId);
        })->with(['grades' => function ($query) use ($assignmentId) {
            $query->where('assignment_id', $assignmentId);
        }])->get();

        // Find the course
        $course = Course::findOrFail($assignment->course_id);

        return view('student-assignment.all_stu_degree', compact('studentsWithGrades', 'assignment', 'course', 'assignmentDegree'));
    }

    public function update(Request $request, Grade $grade)
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
        session()->flash('update', 'Degree updated successfully!');
        return redirect()->back();
    }

    public function showOneStudentGrades($userId)
    {
        $user = Userlogin::with('enrolledCourses', 'assignments')->findOrFail($userId);

        $totalGrade = $user->assignments->sum(function ($assignment) {
            return $assignment->pivot->grade;
        });

        $course_title = $user->enrolledCourses->pluck('course_title')->first();

        return view('student-assignment.stu_full_course_degree', ['user' => $user, 'totalGrade' => $totalGrade, 'course_title' => $course_title]);
    }

}
