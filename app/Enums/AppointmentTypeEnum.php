<?php

namespace App\Enums;

enum AppointmentTypeEnum: string
{
    //
    case Consult = 'Consult';
    case Treatment = 'Treatment';
    case Control = 'Control';
    case Urgent = 'Urgent';

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
