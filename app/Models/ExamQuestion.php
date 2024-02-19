<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ExamQuestion extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function student_answer()
    {
        return $this->hasOne(AnswerDetails::class)->where('user_id', auth()->user()->id);
    }

    public function answers()
    {
        return $this->hasMany(ExamQuestionAnswer::class);
    }

    public function right_answer()
    {
        return $this->hasOne(ExamQuestionAnswer::class)->where('correct', 1);
    }

    public function wrong_answers()
    {
        return $this->hasMany(ExamQuestionAnswer::class)->where('correct', 0);
    }
}
