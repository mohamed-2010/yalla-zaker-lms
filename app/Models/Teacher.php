<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Teacher extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasRoles;
    use InteractsWithMedia;
    protected $guard = 'teacher';

    // protected $guarded = [];
    
    protected $fillable = [
        'name', 'email', 'password', 'bio', 'insta_url', 'fb_url', 'yt_url', 'tk_url', 'whatsapp'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher', 'teacher_id', 'subject_id');
    }

    public function recordedLessons()
    {
        return $this->hasMany(RecordedLesson::class);
    }

    // public function groups()
    // {
    //     return $this->hasMany('App\Models\Student\Group');
    // }
}
