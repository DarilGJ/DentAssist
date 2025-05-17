<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AppointmentTypeEnum: string implements HasLabel
{
    //
    case Consult = 'consult';
    case Treatment = 'treatment';
    case Control = 'control';
    case Urgent = 'urgent';

    public static function getValuesToArray(): array
    {
        return [

            self::Consult->value,
            self::Treatment->value,
            self::Control->value,
            self::Urgent->value,

        ];
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Consult => __('Consulta'),
            self::Treatment => __('Tratamiento'),
            self::Control => __('Control'),
            self::Urgent => __('Urgente'),
        };
    }
}
