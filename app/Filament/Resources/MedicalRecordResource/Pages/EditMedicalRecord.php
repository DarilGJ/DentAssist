<?php

namespace App\Filament\Resources\MedicalRecordResource\Pages;

use App\Filament\Resources\MedicalRecordResource;
use App\Models\MedicalRecord;
use Filament\Actions;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditMedicalRecord extends EditRecord
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
                    ]),

                Placeholder::make('created_at')
                    ->label('Creado')
                    ->content(fn (?MedicalRecord $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Actualizado')
                    ->content(fn (?MedicalRecord $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
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
