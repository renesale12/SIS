<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count(); // Total students
        $totalSubjects = Subject::count(); // Total subjects
        $totalEnrolled = Enrollment::distinct('student_id')->count(); // Enrolled students
        $unenrolledStudents = $totalStudents - $totalEnrolled; // Unenrolled students
    
        // Get subjects with the count of enrolled students
        $subjects = Subject::withCount('enrollments')->get();
    
        // Extract subject names and enrollment counts for the Blade view
        $subjectNames = $subjects->pluck('name')->toArray();
        $enrolledCounts = $subjects->pluck('enrollments_count')->toArray();
    
        return view('dashboard', compact('totalStudents', 'totalSubjects', 'totalEnrolled', 'unenrolledStudents', 'subjectNames', 'enrolledCounts'));
    }
    
}
