<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponeCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id', 'count_of_days', 'count_of_views', 'code', 'video_count'
    ];

    public function coupone_code_videos() {
        return $this->hasMany(CouponeCodeVideo::class);
    }

}
