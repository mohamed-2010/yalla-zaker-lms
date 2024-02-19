<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class RecordedLesson extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function subject() {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function couponeCodes()
    {
        return $this->belongsToMany(CouponeCode::class, 'coupone_code_videos', 'recorded_lesson_id', 'coupone_code_id');
    }

    
}
