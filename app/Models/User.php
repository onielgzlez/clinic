<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'second_name',
        'last_name',
        'last_name2',        
        'document',        
        'phone',        
        'photo',        
        'status',        
        'type',        
        'city_id',        
        'area_job_id',        
        'classificator_id',        
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->second_name} {$this->last_name} {$this->last_name2}";
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getShortNameAttribute()
    {
        return "{$this->first_name}";
    }
    
    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFirstLetterAttribute()
    {
        $n = $this->first_name[0];
        $l = $this->last_name[0];
        return "$n$l";
    }

    public function roles() {
        return $this
            ->belongsToMany(Role::class,'user_roles');
    }

    public function authorizeRoles($roles) {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyRole($roles) {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role) {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function organizations() {
        return $this
            ->belongsToMany(Organization::class,'organization_workers');
    }

    /**
     * Get the city that owns the user.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the area job that owns the user.
     */
    public function area()
    {
        return $this->belongsTo(AreaJob::class);
    }
    
    /**
     * Get the area job that owns the user.
     */
    public function classificator()
    {
        return $this->belongsTo(Classificator::class);
    }
}
