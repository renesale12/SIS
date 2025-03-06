<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
{
    public function rules() {
        $rules = [
            'grade' => 'required|numeric|min:1|max:5', // Only grade is required when updating
        ];
    
        if ($this->isMethod('post')) { // Only require student_id and subject_id when creating a new grade
            $rules['student_id'] = 'required|exists:students,id';
            $rules['subject_id'] = 'required|exists:subjects,id';
        }
    
        return $rules;
    }
    
}