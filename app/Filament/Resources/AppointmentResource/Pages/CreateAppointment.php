<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentTypeEnum;
use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Patient;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateAppointment extends CreateRecord
{
    protected static string $resource = AppointmentResource::class;
    protected static ?string $navigationLabel = 'Crear Cita';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patient_id')
                    ->label('Paciente')
                    ->options(Patient::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Hidden::make('user_id')
                    ->default(auth()->id()),

                DatePicker::make('date_at')
                    ->minDate(now())
                    ->label('Fecha')
                    ->required(),

                TimePicker::make('hour_in')
                    ->label('Hora')
                    ->required(),

                Select::make('type')
                    ->label('Tipo de Cita')
                    ->options(AppointmentTypeEnum::class)
                    ->required(),

                TextArea::make('reason')
                    ->label('Descripcion'),

                Select::make('status')
                    ->label('Estado de Cita')
                    //->options(AppointmentStatusEnum::class)
                    ->options(AppointmentStatusEnum::getCreatOptions())
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Creado')
                    ->content(fn (?Appointment $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Actualizado')
                    ->content(fn (?Appointment $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }
    public static function getModelLabel(): string
    {
        return 'Crear Cita';
    }
}
