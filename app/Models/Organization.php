<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'modules_active',
        'email',        
        'phone',        
        'address',        
        'status', 
        'user_id',        
        'city_id',
    ];

     /**
     * Get the city that owns the provider.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

     /**
     * Get the user that owns the organization.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patients() {
        return $this
            ->belongsToMany(Patient::class,'organization_patients')
            ->withTimestamps();
    }
    
    public function workers() {
        return $this
            ->belongsToMany(User::class,'organization_workers')
            ->withTimestamps();
    }
    
    public function products() {
        return $this
            ->belongsToMany(Product::class,'organization_products')
            ->withTimestamps();
    }
    
    public function providers() {
        return $this
            ->belongsToMany(Provider::class,'organization_providers')
            ->withTimestamps();
    }
}
