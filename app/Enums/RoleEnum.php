<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;

enum RoleEnum: string implements HasColor
{
    case patient = 'patient';
    case clinic = 'clinic';
    case admin = 'admin';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::patient => Color::Blue,
            self::clinic => Color::Green,
            self::admin => Color::Red,
        };
    }
}
