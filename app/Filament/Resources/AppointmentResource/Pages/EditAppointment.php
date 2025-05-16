<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentTypeEnum;
use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Patient;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Columns\TextColumn;
use phpDocumentor\Reflection\Types\False_;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('patient_id')
                    ->label('Paciente')
                    ->options(Patient::all()->pluck('name', 'id'))
                    ->disabled(true),

                Hidden::make('user_id')
                    ->default(auth()->id()),

                DatePicker::make('date_at')
                    ->label('Fecha')
                    ->minDate(now())
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
                    ->options(AppointmentStatusEnum::getEditOptions())
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Creado')
                    ->content(fn (?Appointment $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Actualizado')
                    ->content(fn (?Appointment $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
