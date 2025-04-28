<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\MaritalStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'surname',
        'birth_at',
        'phone',
        'gender',
        'marital_status',
        'email',
        'allergies',
        'address',
    ];

    protected function casts(): array
    {
        return [
            'birth_at' => 'date',
            'gender' => GenderEnum::class,
            'marital_status' => MaritalStatusEnum::class,
        ];
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
