<?php

namespace App\Models;

use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'user_id',
        'date_at',
        'hour_in',
        'type',
        'reason',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date_at' => 'date',
            'type' => AppointmentTypeEnum::class,
            'status' => AppointmentStatusEnum::class,
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
