<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class StudentSession extends Model
{
    protected $fillable = [
        'user_id',
        'ip',
        'platform_name',
        'platform_family',
        'platform_version',
        'browser_name',
        'browser_family',
        'browser_version',
        'device_family',
        'device_model',
        'mobile_grade'
    ];

    const UPDATED_AT = null;
}
