<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Grade;

class StudentViewController extends Controller
{
    /**
     * Show the student's enrolled subjects and grades.
     */
    public function index()
    {
        // Get the authenticated student
        $student = Auth::guard('student')->user();

        if (!$student) {
            return redirect()->route('login')->withErrors(['error' => 'Unauthorized access.']);
        }

        // Get student's enrolled subjects with grades
        $enrollments = Enrollment::where('student_id', $student->id)
            ->with(['subject', 'grades'])
            ->get();

        // Calculate GWA (General Weighted Average)
        $totalGrades = 0;
        $totalSubjects = 0;

        foreach ($enrollments as $enrollment) {
            $grade = optional($enrollment->grades->first())->grade;
            if (is_numeric($grade)) {  
                $totalGrades += (float) $grade;
                $totalSubjects++;
            }
        }

        $gwa = $totalSubjects > 0 ? number_format($totalGrades / $totalSubjects, 2) : null;

        return view('studentviews.index', compact('student', 'enrollments', 'gwa'));
    }
}