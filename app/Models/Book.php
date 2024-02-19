<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Book extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }
    
}
