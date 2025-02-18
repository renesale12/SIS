<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model {
    use HasFactory;
    
    protected $fillable = ['student_id', 'subject_id', 'grade'];

    protected $casts = [
        'grade' => 'decimal:2', // Ensure grades are stored as decimals with 2 decimal places
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}


