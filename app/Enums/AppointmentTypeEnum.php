<?php

namespace App\Enums;

enum AppointmentTypeEnum: string
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
}
