<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentTypeEnum;
use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Patient;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Paciente')
                    ->relationship('patient')
                    ->schema([
                        Placeholder::make('name')
                            ->label('Nombres')
                            ->content(fn ($record) => $record->name)
                            ->disabled(true),

                        Placeholder::make('surname')
                            ->label('Apellidos')
                            ->content(fn ($record) => $record->surname)
                            ->disabled(true),

                        Placeholder::make('allergies')
                            ->label('Alergias')
                            ->content(fn ($record) => $record->allergies)
                            ->disabled(true)
                            ->columnSpan(3),

                        Placeholder::make('email')
                            ->label('Email')
                            ->content(fn ($record) => $record->email)
                            ->disabled(true),

                        Placeholder::make('phone')
                            ->label('Telefono')
                            ->content(fn ($record) => $record->phone),

                        Placeholder::make('App\Models\Patient.gender')
                            ->label('Genero')
                            ->content(fn ($record) => $record->gender->getLabel()),

                        Placeholder::make('address')
                            ->label('Direccion')
                            ->content(fn ($record) => $record->address),

                        Placeholder::make('birth_at')
                            ->label('Fecha de Nacimiento')
                            ->content(fn ($record) => $record->birth_at->format('d/m/Y')),

                        Placeholder::make('App\Models\Patient.marital_status')
                            ->label('Estado Civil')
                            ->content(fn ($record) => $record->marital_status->getLabel()),

                    ])
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data) {
                        $data['patient_id'] = $this->record->patient_id;

                        return $data;
                    }),

                Hidden::make('user_id')
                    ->default(auth()->id()),

                Fieldset::make('Cita')
                    ->schema([
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

                        Select::make('status')
                            ->label('Estado de Cita')
                            // ->options(AppointmentStatusEnum::class)
                            ->options(AppointmentStatusEnum::getCreatOptions())
                            ->required(),

                        TextArea::make('reason')
                            ->label('Descripcion')
                            ->columnSpan(2),

                    ]),

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
