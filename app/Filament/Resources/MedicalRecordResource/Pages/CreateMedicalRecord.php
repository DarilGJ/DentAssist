<?php

namespace App\Filament\Resources\MedicalRecordResource\Pages;

use App\Enums\GenderEnum;
use App\Enums\MaritalStatusEnum;
use App\Filament\Resources\MedicalRecordResource;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicalRecord extends CreateRecord
{
    protected static string $resource = MedicalRecordResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('patient_id')
                    ->label('Paciente')
                    ->options(Patient::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $this->loadPatientData($state, $set)),

                //                Select::make('appointment_id')
                //                ->label('Cita')
                //                ->options(Appointment::with('patient')->get()->mapWithKeys(function ($appointment) {
                //                    return [$appointment->id => $appointment->patient->name . ' ' . $appointment->date_at->format('d-m-Y')];
                //                }))
                //                ->searchable()
                //                ->reactive()
                //                ->afterStateUpdated(fn($state, callable $set) => $this->loadAppointmentData($state, $set)),

                Fieldset::make('Paciente')
                    // ->relationship('patient')
                    ->schema([

                        TextInput::make('name')
                            ->label('Nombre')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('surname')
                            ->label('Apellido')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('allergies')
                            ->label('Alergias')
                            ->disabled()
                            ->columnSpan(3)
                            ->dehydrated(false),

                        TextInput::make('email')
                            ->email()
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('phone')
                            ->label('Telefono')
                            ->tel()
                            // ->telRegex('/^\d{8}$/')
                            ->disabled()
                            ->dehydrated(false),

                        Select::make('gender')
                            ->label('Genero')
                            ->options(GenderEnum::class)
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('address')
                            ->label('Direccion')
                            // ->default('Ciudad')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('birth_at')
                            ->label('Fecha de Nacimiento')
                            ->disabled()
                            ->dehydrated(false),

                        Select::make('marital_status')
                            ->label('Estado Civil')
                            ->options(MaritalStatusEnum::class)
                            // ->default('single'),
                            ->disabled()
                            ->dehydrated(false),

                    ]),
                // //                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data) {
                // //                        $data['patient_id'] = $this->record->patient_id;
                // //
                // //                        return $data;
                //                    }),

                Hidden::make('user_id')
                    ->default(auth()->id()),

                Fieldset::make('Expediente')
                    ->schema([
                        TextArea::make('diagnosis')
                            ->label('Diagnostico')
                            ->required(),

                        TextArea::make('treatment')
                            ->label('Tratamiento')
                            ->required(),

                        FileUpload::make('xray')
                            ->label('Rayos X')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'image/jpeg',
                                'image/png',
                            ]),

                        FileUpload::make('photo')
                            ->label('Fotos')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'image/jpeg',
                                'image/png',
                            ]),
                    ]),

                Placeholder::make('created_at')
                    ->label('Creado')
                    ->content(fn (?MedicalRecord $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Actualizado')
                    ->content(fn (?MedicalRecord $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    protected function loadPatientData($patientId, callable $set): void
    {
        if (! $patientId) {
            $set('name', '');
            $set('surname', '');
            $set('birth_at', '');
            $set('phone', '');
            $set('gender', '');
            $set('marital_status', '');
            $set('email', '');
            $set('allergies', '');
            $set('address', '');

            return;
        }
        $patient = Patient::find($patientId);

        if ($patient) {
            $set('name', $patient->name);
            $set('surname', $patient->surname);
            $set('birth_at', $patient->birth_at->format('d/m/Y'));
            $set('phone', $patient->phone);
            $set('gender', $patient->gender);
            $set('marital_status', $patient->marital_status);
            $set('email', $patient->email);
            $set('allergies', $patient->allergies);
            $set('address', $patient->address);
        }
    }

    //    protected function loadAppointmentData($appointmentId, callable $set): void
    //    {
    //        if (!$appointmentId){
    //            $set('patient_id', null);
    //            $this->loadPatientData(null, $set);
    //            return;
    //        }
    //        $appointment = Appointment::with('patient')->find($appointmentId);
    //        if($appointment && $appointment->patient){
    //            $set('patient_id', $appointment->patient_id);
    //            $this->loadPatientData($appointment->patient_id, $set);
    //
    //        }
    //    }

}
