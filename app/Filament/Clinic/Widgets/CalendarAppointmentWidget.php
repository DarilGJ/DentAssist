<?php

namespace App\Filament\Clinic\Widgets;

use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentTypeEnum;
use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarAppointmentWidget extends FullCalendarWidget
{
    public string|null|Model $model = Appointment::class;

    public function fetchEvents(array $info): array
    {
        return Appointment::query()
            ->where('date_at', '>=', $info['start'])
            ->with('patient')
            ->get()
            ->map(fn (Appointment $appointment) => [
                'id' => $appointment->id,
                'title' => "Cita con {$appointment->patient->name}",
                'start' => Carbon::parse("{$appointment->date_at->format('Y-m-d')} {$appointment->hour_in}"),
                'end' => Carbon::parse("{$appointment->date_at->format('Y-m-d')} {$appointment->hour_in}")->addMinutes(30),
                'url' => AppointmentResource::getUrl(name: 'process', parameters: ['record' => $appointment->id]),
            ])
            ->all();
    }

    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('patient_id')
                ->label('Paciente')
                ->relationship('patient', 'name')
                ->preload()
                ->required()
                ->searchable(),

            Forms\Components\Hidden::make('user_id')
                ->default(auth()->id()),

            Forms\Components\Select::make('type')
                ->label('Tipo de Cita')
                ->options(AppointmentTypeEnum::class)
                ->required(),

            Forms\Components\Textarea::make('reason')
                ->label('Motivo de la Cita')
                ->rows(3)
                ->required(),

            Forms\Components\Select::make('status')
                ->label('Estado de Cita')
                ->options(AppointmentStatusEnum::class)
                ->default(AppointmentStatusEnum::Scheduled)
                ->required(),

            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\DatePicker::make('date_at')
                        ->label('Fecha')
                        ->native(false)
                        ->required()
                        ->minDate(now()),

                    Forms\Components\TimePicker::make('hour_in')
                        ->label('Hora')
                        ->format('H:i')
                        ->required(),
                ]),
        ];
    }
}
