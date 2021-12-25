<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaJob extends Model
{
    use HasFactory;
    protected $table = "areas";

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the workers that owns the area.
     */
    public function workers()
    {
        return $this->hasMany(User::class);
    }

    public $timestamps = false;

    public function organizations() {
        return $this
            ->belongsToMany(Organization::class,'organization_specialties');
    }
}
