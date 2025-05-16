<?php

namespace App\Filament\Resources\MedicalRecordResource\Pages;

use App\Filament\Resources\MedicalRecordResource;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicalRecord extends CreateRecord
{
    protected static string $resource = MedicalRecordResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([

//                Hidden::make('appointment_id')
//                   ->label('No. Cita')
//                    ->options(Appointment::all()->pluck('id', 'id'))
//                    ->searchable(),

                Select::make('patient_id')
                    ->label('Paciente')
                    ->options(Patient::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),

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
                    ->required(),

                FileUpload::make('photo')
                    ->label('Fotos')
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
