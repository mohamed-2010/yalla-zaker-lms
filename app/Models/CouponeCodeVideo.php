<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponeCodeVideo extends Model
{
    use HasFactory;

    protected $fillable = ['coupone_code_id', 'recorded_lesson_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
