<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum GenderEnum: string implements HasColor, HasLabel
{
    case Male = 'male';
    case Female = 'female';
    case Other = 'other';

    public static function getValuesToArray(): array
    {
        return [
            self::Male->value,
            self::Female->value,
            self::Other->value,
        ];
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Male => Color::Blue,
            self::Female => Color::Pink,
            self::Other => Color::Gray,
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Male => __('Masculino'),
            self::Female => __('Femenino'),
            self::Other => __('Otro'),
        };
    }
}
