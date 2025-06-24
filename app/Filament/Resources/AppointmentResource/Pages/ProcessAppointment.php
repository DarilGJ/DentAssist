<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentTypeEnum;
use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Patient;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class ProcessAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Procesar Cita';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('Finalizar Cita'),
            $this->getCancelFormAction()
                ->label('Cancelar Cita'),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['status'] = AppointmentStatusEnum::Ended->value;

        return $data;
    }

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
                            ->disabled(true)
                            ->required(),

                        TimePicker::make('hour_in')
                            ->label('Hora')
                            ->disabled(true)
                            ->required(),

                        Select::make('type')
                            ->label('Tipo de Cita')
                            ->options(AppointmentTypeEnum::class)
                            ->disabled(true)
                            ->required(),

                        TextArea::make('reason')
                            ->label('Descripcion')
                            ->disabled(true)
                            ->columnSpan(3),

                    ]),

                Fieldset::make('Agregar Expendiente')
                    ->relationship('medicalRecord')
                    ->schema([

                        TextArea::make('diagnosis')
                            ->label('Diagnostico')
                            ->required(),

                        TextArea::make('treatment')
                            ->label('Tratamiento')
                            ->required(),

                        FileUpload::make('xray')
                            ->label('Rayos X'),

                        FileUpload::make('photo')
                            ->label('Fotos'),
                    ])
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data) {
                        $data['patient_id'] = $this->record->patient_id;
                        $data['user_id'] = auth()->id();

                        return $data;
                    }),

                Placeholder::make('status_current')
                    ->label('Estado actual de cita')
                    ->content(fn (?Appointment $record): string => $record?->status?->getLabel() ?? '-'),

                Select::make('status')
                    ->label('Estado nuevo de cita')
                    ->options(AppointmentStatusEnum::getEndOptions())
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Creado')
                    ->content(fn (?Appointment $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Actualizado')
                    ->content(fn (?Appointment $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

            ]);
    }
}

