<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
{
    public function rules() {
        $rules = [
            'grade' => [
                'required',
                'in:1.0,1.25,1.5,1.75,2.0,2.25,2.5,2.75,3.0,3.25,3.5,3.75,4.0,4.25,4.5,4.75,5.0'
            ],
        ];
    
        if ($this->isMethod('post')) { // Only require student_id and subject_id when creating a new grade
            $rules['student_id'] = 'required|exists:students,id';
            $rules['subject_id'] = 'required|exists:subjects,id';
        }
    
        return $rules;
    }
}