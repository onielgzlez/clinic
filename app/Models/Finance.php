<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',
        'amount',
        'concepts',
        'f_date',
        'pay_date',
        'order',
        'patient_id',
        'user_id',
        'organization_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
