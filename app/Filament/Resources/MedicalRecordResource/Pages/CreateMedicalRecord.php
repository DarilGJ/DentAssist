<?php

namespace App\Filament\Resources\MedicalRecordResource\Pages;

use App\Enums\GenderEnum;
use App\Enums\MaritalStatusEnum;
use App\Filament\Resources\MedicalRecordResource;
use App\Models\MedicalRecord;
use Filament\Forms\Components\DatePicker;
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

                Fieldset::make('Paciente')
                    ->relationship('patient')
                    ->schema([
                        TextInput::make('patient_id')
                            ->label('Nombre')
                            ->columnSpan(3),

                        DatePicker::make('birth_at')
                            ->label('Fecha de Nacimiento'),

                        Select::make('App\Models\Patient.marital_status')
                            ->label('Estado Civil')
                            ->options(MaritalStatusEnum::class),

                        Select::make('App\Models\Patient.gender')
                            ->label('Genero')
                            ->options(GenderEnum::class),

                        TextInput::make('phone')
                            ->label('Telefono'),

                        TextInput::make('address')
                            ->label('Direccion'),
                    ])
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data) {
                        $data['patient_id'] = $this->record->patient_id;

                        return $data;
                    }),

                Hidden::make('user_id')
                    ->default(auth()->id()),

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
                    ])
                    ->required(),

                FileUpload::make('photo')
                    ->label('Fotos')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'image/jpeg',
                        'image/png',
                    ])
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Creado')
                    ->content(fn (?MedicalRecord $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Actualizado')
                    ->content(fn (?MedicalRecord $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);

    }
}
