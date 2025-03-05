<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Student extends Authenticatable {
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', // Added 'role'
    ];

    protected $hidden = [
        'password',
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function ($student) {
            if (!$student->password) {
                $student->password = Hash::make('12345678'); // Default password
            }
            if (!$student->role) {
                $student->role = 'student'; // Default role
            }
        });
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }
    
}

