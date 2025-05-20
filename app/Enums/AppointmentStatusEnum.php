<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AppointmentStatusEnum: string implements HasLabel
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

    public static function getCreatOptions(): array
    {
        return [
            self::Scheduled->value => 'Programada',
            self::Confirmed->value => ('Confirmada'),
        ];
    }

    public static function getEditOptions(): array
    {
        return [
            self::Rescheduled->value => ('Reprogramada'),
            self::Confirmed->value => ('Confirmada'),
            self::InProgress->value => ('En Progreso'),
            self::Cancelled->value => ('Cancelada'),
        ];
    }

    public static function getEndOptions(): array
    {
        return [
            self::Ended->value => ('Finalizada'),
            self::Cancelled->value => ('Cancelada'),
        ];
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Scheduled => __('Programada'),
            self::Rescheduled => __('Reprogramada'),
            self::Confirmed => __('Confirmada'),
            self::InProgress => __('En Progreso'),
            self::Ended => __('Finalizada'),
            self::Cancelled => __('Cancelada'),
            self::DidNotAttend => __('Sin Asistir'),
        };
    }
}
