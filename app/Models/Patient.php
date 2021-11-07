<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
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
        'telephone',
        'jobphone',
        'photo',
        'whatsapp',
        'reference',
        'phone_reference',
        'whatsapp_reference',
        'contact_via',
        'prospectus',
        'birthdate',
        'address',
        'address_job',
        'city_id',
        'email',
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

    public function getAvatarAttribute()
    {
        return $this->photo ?? 'media/users/default.jpg';
    }

    public function organizations()
    {
        return $this
            ->belongsToMany(Organization::class, 'organization_patients');
    }

    public function getNameClinicsAttribute()
    {
        $roles = $this->organizations()->pluck('name')->all();
        return join(', ', $roles);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
