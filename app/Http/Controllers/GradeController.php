<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;

class GradeController extends Controller {
    // Display a list of grades
    public function index() {
        $grades = Grade::with(['student', 'subject'])->get();
        $students = Student::all(); // Fetch all students
        $subjects = Subject::all(); // Fetch all subjects
    
        return view('grades.index', compact('grades', 'students', 'subjects'));
    }
    

    // Show the form to create a new grade
    public function create() {
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.create', compact('students', 'subjects'));
    }

    // Store a new grade
    public function store(Request $request) {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|numeric|min:1|max:5', // University grading scale
        ]);

        Grade::create($request->all());
        return redirect()->route('grades.index')->with('success', 'Grade recorded successfully.');
    }

    // Show the form to edit an existing grade
    public function edit($id) {
        $grade = Grade::findOrFail($id);
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    // Update an existing grade
   public function update(Request $request, $id) {
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'subject_id' => 'required|exists:subjects,id',
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

