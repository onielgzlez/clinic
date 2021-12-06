<?php

namespace App\Models;

use App\Traits\HasLocalDates;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Thomasjohnkane\Snooze\Traits\SnoozeNotifiable;

class User extends Authenticatable
{
    use Notifiable, SnoozeNotifiable,HasApiTokens, HasFactory;

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
        'headerTheme',
        'sideTheme',
        'brandTheme',
        'colorTheme',
        'mobileTheme',
        'desktopTheme',
        'locale',
        'timezone',
        'options',
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
        'options' => AsArrayObject::class,
    ];

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return array|string
     */
    public function routeNotificationForMail($notification = null)
    {
        return $this->email;
    }

    public function routeNotificationForWhatsApp($notification = null)
    {
        return $this->phone;
    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSms($notification = null)
    {
        return $this->phone;
    }

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

    public function roles()
    {
        return $this
            ->belongsToMany(Role::class, 'user_roles');
    }

    public function getNameRolesAttribute()
    {
        $roles = $this->roles()->pluck('name')->all();
        return join(', ', $roles);
    }

    public function getAvatarAttribute()
    {
        return $this->photo ?? 'media/users/default.jpg';
    }

    public function isAdmin()
    {
        return $this->hasRole('Administrador');
    }

    public function status()
    {
        return $this->status == 1 ? 'Activo' : ($this->status == 2 ? 'Pendiente' : 'Suspendido');
    }

    public function isAdminClinic()
    {
        return $this->hasRole('Administrador clínica');
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyRole($roles)
    {
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

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function organizations()
    {
        return $this
            ->belongsToMany(Organization::class, 'organization_workers');
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
    public function area_job()
    {
        return $this->belongsTo(AreaJob::class);
    }

    public function getSpecialtyAttribute()
    {
        return $this->area_job->name ?? '';
    }

    /**
     * Get the area job that owns the user.
     */
    public function classificator()
    {
        return $this->belongsTo(Classificator::class);
    }

    public function getClassificationAttribute()
    {
        return $this->classificator->name ?? '';
    }
}
