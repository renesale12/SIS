<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Subject;

class StudentController extends Controller {
    public function index() {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create() {
        $students = Student::all();
        $subjects = Subject::all();
        
        return view('grades.create', compact('students', 'subjects'));
    }

    // Store new student with default password
    public function store(Request $request) {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        
        ]);
    
        try {
            // Create student with default password
            Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('12345678'), // Default password
            ]);
    
            return redirect()->route('students.index')->with('success', 'Student added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit(Student $student) {
        return view('students.edit', compact('student'));
    }
    
    public function update(Request $request, Student $student) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);

        // Check if password is provided
        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }

        $student->update($request->except('password'));
    
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }
    
    public function destroy(Student $student) {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
