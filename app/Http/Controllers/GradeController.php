<?php

namespace App\Http\Controllers;
use App\Http\Requests\GradeRequest;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Enrollment;


class GradeController extends Controller {
    // Display a list of grades
    public function index() {
        $grades = Grade::with(['student', 'subject'])->get();
        $students = Student::all(); // Fetch all students
        $subjects = Subject::all(); // Fetch all subjects
    
        return view('grades.index', compact('grades', 'students', 'subjects'));
    }
    

    // Show the form to create a new grade
    public function create()
{
    $enrolledStudents = Student::whereHas('enrollments')->get();
    $subjects = Subject::all();

    // Debugging: Check the fetched data
    dd($enrolledStudents, $subjects);

    return view('grades.create', compact('enrolledStudents', 'subjects'));
}

    // Store a new grade
    public function store(GradeRequest $request)
    {
      
    
        // Find the enrollment (it must exist for a student to receive a grade)
        $enrollment = Enrollment::where('student_id', $request->student_id)
            ->where('subject_id', $request->subject_id)
            ->first();
    
        if (!$enrollment) {
            return redirect()->back()->withErrors(['error' => 'Student is not enrolled in this subject!']);
        }

        // Check if the student is already graded for the subject
    $existingGrade = Grade::whereHas('enrollment', function ($query) use ($request) {
        $query->where('student_id', $request->student_id)
              ->where('subject_id', $request->subject_id);
    })->first();

    if ($existingGrade) {
        return redirect()->back()->withErrors(['error' => 'Student is already graded for the subject!']);
    }
    
        // Create the grade with the correct `enrollment_id`
        Grade::create([
            'enrollment_id' => $enrollment->id,
            'grade' => $request->grade,
        ]);
    
        return redirect()->route('grades.index')->with('success', 'Grade recorded successfully.');
    }
    

    // Show the form to edit an existing grade
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $students = Student::all();
        $subjects = Subject::all();
    
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    // Update an existing grade
   public function update(Request $request, $id) {
    $request->validate([
        'grade' => 'required|numeric|min:1|max:5',
    ]);

    $grade = Grade::findOrFail($id);
    $grade->update($request->all());



    return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
}

    // Delete a grade
    public function destroy($id) {
        Grade::findOrFail($id)->delete();
        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully.');
    }


    
}

