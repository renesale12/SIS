<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model {
    use HasFactory;
    
    protected $fillable = ['enrollment_id', 'grade'];

    protected $casts = [
        'grade' => 'decimal:2', 
    ];

    // Get the enrollment associated with the grade
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    // Get the student through enrollment
    public function student()
    {
        return $this->hasOneThrough(Student::class, Enrollment::class, 'id', 'id', 'enrollment_id', 'student_id');
    }

    // Get the subject through enrollment
    public function subject()
    {
        return $this->hasOneThrough(Subject::class, Enrollment::class, 'id', 'id', 'enrollment_id', 'subject_id');
    }
}



