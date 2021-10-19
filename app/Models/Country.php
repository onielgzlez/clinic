<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * Get the states for the country.
     */
    public function states()
    {
        return $this->hasMany(Region::class);
    }
}
