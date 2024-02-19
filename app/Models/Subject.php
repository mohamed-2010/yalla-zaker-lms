<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Subject extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'subjects';

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'grade_id',
    ];

    /**
     * Scope a query to only include active grades.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
    
    public function grade() {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'subject_categories', 'subject_id', 'category_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher', 'subject_id', 'teacher_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function recordedLessons() {
        return $this->hasMany(RecordedLesson::class);
    }
}
