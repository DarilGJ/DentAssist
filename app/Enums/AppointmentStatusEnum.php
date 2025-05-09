<?php

namespace App\Enums;

enum AppointmentStatusEnum: string
{
    //
    case Scheduled = 'scheduled';
    case Rescheduled = 'rescheduled';
    case Confirmed = 'confirmed';
    case InProgress = 'inProgress';
    case Ended = 'ended';
    case Cancelled = 'cancelled';
    case DidNotAttend = 'didNotAttend';

    public static function getValuesToArray(): array
    {

        return [
            self::Scheduled->value,
            self::Rescheduled->value,
            self::Confirmed->value,
            self::InProgress->value,
            self::Ended->value,
            self::Cancelled->value,
            self::DidNotAttend->value,

        ];
    }
}
