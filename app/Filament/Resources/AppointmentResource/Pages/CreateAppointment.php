<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Enums\AppointmentStatusEnum;
use App\Enums\AppointmentTypeEnum;
use App\Enums\GenderEnum;
use App\Enums\MaritalStatusEnum;
use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Patient;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $this->loadPatientData($state, $set)),

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

    public static function getModelLabel(): string
    {
        return 'Crear Cita';
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
}
