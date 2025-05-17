<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum RoleEnum: string implements HasColor, HasLabel
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

    public function getLabel(): ?string
    {
        return match ($this) {
            self::patient => __('Paciente'),
            self::clinic => __('Clinica'),
            self::admin => __('Administrador'),
        };
    }
}
