<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Grade extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'grades';

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

    /**
     * Get the subjects for the grade.
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

}
