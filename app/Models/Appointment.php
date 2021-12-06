<?php

namespace App\Models;

use App\Traits\HasLocalDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Thomasjohnkane\Snooze\Traits\SnoozeNotifiable;

class Appointment extends Model
{
    use Notifiable, SnoozeNotifiable,HasFactory, HasLocalDates;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'init',
        'end',
        'observation',
        'status',
        'user_id',
        'organization_id',
        'area_job_id',
        'patient_id',
    ];

    public function area_job()
    {
        return $this->belongsTo(AreaJob::class);
    }

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

    public function getColorAttribute()
    {
        if ($this->status == 1) {
            return '#de676b';
        }

        if ($this->status == 2) {
            return '#47adba';
        }

        if ($this->status == 3 || $this->status == 5 || $this->status == 6) {
            return '#c3c3c3';
        }

        if ($this->status == 4) {
            return '#289bdc';
        }
    }

    public function getStateAttribute()
    {
        if ($this->status == 1) {
            return 'Reservada';
        }

        if ($this->status == 2) {
            return 'Aprobada';
        }

        if ($this->status == 3) {
            return 'Cancelada';
        }

        if ($this->status == 4) {
            return 'Realizada';
        }

        if ($this->status == 5) {
            return 'Archivada';
        }
    }
}
