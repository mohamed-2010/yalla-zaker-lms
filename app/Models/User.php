<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user sessions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userSessions()
    {
        return $this->hasMany(StudentSession::class);
    }

    /**
     * Check if the user is banned.
     *
     * @return bool
     */
    public function isBanned()
    {
        if($this->account_status == "new" || $this->account_status == "ban") {
            return true;
        }
        return false;
    }

    /**
     * Get the user session.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userSession()
    {
        return $this->hasOne(StudentSession::class);
    }

    /**
     * Record a session for the user.
     *
     * @param array $data
     * @return \App\Models\StudentSession
     */
    public function recordSession()
    {
        $agent = new Agent();
    
        $data = [
            'ip' => request()->ip(),
            'platform_name' => $agent->platform(),
            'platform_family' => $agent->device(),
            'platform_version' => $agent->version($agent->platform()),
            'browser_name' => $agent->browser(),
            'browser_family' => $agent->browser(),
            'browser_version' => $agent->version($agent->browser()),
            'device_family' => $agent->device(),
            'device_model' => $agent->device(),
            'mobile_grade' => $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop'),
        ];

        // Check if a session with the same device characteristics already exists
        $existingSession = $this->userSessions()->where([
            ['ip', '=', $data['ip']],
            ['device_family', '=', $data['device_family']],
            ['device_model', '=', $data['device_model']],
            // Add more conditions here if necessary
        ])->first();

        // If a session does not exist, create a new one
        if (!$existingSession) {
            return $this->userSessions()->create($data);
        }
    
        return null;
    }

    // public function grade() {
        
    // }
    
    
}
