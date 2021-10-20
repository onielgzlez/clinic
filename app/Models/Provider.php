<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
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
     * Get the products that owns the provider.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function organizations() {
        return $this
            ->belongsToMany(Organization::class,'organization_providers');
    }
}
