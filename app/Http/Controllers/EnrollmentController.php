<?php

namespace App\Http\Controllers;
use App\Http\Requests\EnrollmentRequest;
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
    

    public function store(EnrollmentRequest $request)
{
    // Check if the student is already enrolled in the subject
    $existingEnrollment = Enrollment::where('student_id', $request->student_id)
        ->where('subject_id', $request->subject_id)
        ->exists();

    if ($existingEnrollment) {
        return redirect()->back()
            ->withErrors(['error' => 'The student is already enrolled in this subject.'])
            ->withInput();
    }

    // Create the enrollment
    Enrollment::create($request->all());

    return redirect()->route('enrollments.index')->with('success', 'Enrollment created successfully.');
}

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }

    public function update(EnrollmentRequest $request, Enrollment $enrollment)
    {
        // Check if the student is already enrolled in the subject
        $existingEnrollment = Enrollment::where('student_id', $enrollment->student_id)
            ->where('subject_id', $request->subject_id)
            ->where('id', '!=', $enrollment->id) // Exclude the current enrollment
            ->first();
    
        if ($existingEnrollment) {
            return redirect()->back()
                ->withErrors(['error' => 'The student is already enrolled in this subject.'])
                ->withInput();
        }
    
        // Update only the subject
        $enrollment->update([
            'subject_id' => $request->subject_id,
        ]);
    
        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }
    
}
