<?php

namespace App\Enums;

enum AppointmentStatusEnum: string
{
    //
    case Scheduled = 'Programada';
    case Rescheduled = 'Reprogramada';
    case Confirmed = 'Confirmada';
    case InProgress = 'En Curso';
    case Ended = 'Finalizada';
    case Cancelled = 'Cancelada';
    case DidNotAttend = 'Ausente';

    public static function getValuesToArray(): array
    {
        return [
            self::Scheduled,
            self::Rescheduled,
            self::Confirmed,
            self::InProgress,
            self::Ended,
            self::Cancelled,
            self::DidNotAttend,
        ];
    }
}
