<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    public function rules()
    {
        // Get the student ID from the request (if it exists)
        $studentId = $this->input('student_id');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $studentId, // Ignore the current student's email
            'password' => 'sometimes|string|min:8',
        ];
    }
}