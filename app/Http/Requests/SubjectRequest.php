<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required|unique:subjects',
            'name' => 'required',
            'units' => 'required|integer',
        ];
    }
}