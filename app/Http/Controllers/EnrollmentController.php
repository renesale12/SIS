<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class EnrollmentController extends Controller

{public function index()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $enrollments = Enrollment::all();
        
        return view('enrollments.index', compact('students', 'subjects', 'enrollments'));
    }
    
    public function create()
    {
        // Fetch all students and subjects from the database
        $students = Student::all();
        $subjects = Subject::all();
    
        return view('enrollments.create', compact('students', 'subjects'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Enrollment::create($request->all());

        return redirect()->route('enrollments.index')->with('success', 'Enrollment created successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
    
}
