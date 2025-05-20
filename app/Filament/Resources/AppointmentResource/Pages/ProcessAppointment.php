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
                Select::make('patient_id')
                    ->label('Paciente')
                    ->options(Patient::all()->pluck('name', 'id'))
                    ->disabled(true),

                Hidden::make('user_id')
                    ->default(auth()->id()),

                DatePicker::make('date_at')
                    ->label('Fecha')
                    ->disabled(true),

                Placeholder::make('patient.birth_at')
                    ->content(fn ($record) => $record->patient->birth_at->format('d/m/Y')),

                TimePicker::make('hour_in')
                    ->label('Hora')
                    ->required(),

                Select::make('type')
                    ->label('Tipo de Cita')
                    ->options(AppointmentTypeEnum::class)
                    ->required(),

                TextArea::make('reason')
                    ->label('Descripcion'),

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
