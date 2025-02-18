<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Subject;

class StudentController extends Controller {
    public function index() {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        
        return view('grades.create', compact('students', 'subjects'));
    }

    // Store new student
    public function store(Request $request) {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'course' => 'required|string|max:255',
        ]);
    
        try {
            // Create the student
            Student::create($request->all());
    
            // Redirect with success message
            return redirect()->route('students.index')->with('success', 'Student added successfully!');
        } catch (\Exception $e) {
            // Redirect with error message in case of any other unexpected error
            return redirect()->route('students.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}