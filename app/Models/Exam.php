<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function student_answer()
    {
        return $this->hasOne(ExamAnswer::class)->where('user_id', auth()->user()->id);
    }

    public function answers()
    {
        return $this->hasMany(ExamAnswer::class)->orderBy('student_grade', 'asc');
    }
}
