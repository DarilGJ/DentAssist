<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalRecordResource\Pages;
use App\Models\MedicalRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalRecordResource extends Resource
{
    protected static ?string $model = MedicalRecord::class;

    protected static ?string $slug = 'medical-record';

    protected static ?string $navigationLabel = 'Expediente Medico';

    protected static ?string $navigationIcon = 'heroicon-m-clipboard-document-list';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('appointment.id')
                    ->label('No. Cita')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('patient.name')
                    ->label('Paciente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('diagnosis')
                    ->label('Diagnostico'),

                TextColumn::make('treatment')
                    ->label('Tratamiento'),

                Tables\Columns\ImageColumn::make('xray')
                    ->label('Rayos X')
                    //->defaultImageUrl(url('storage'))
                    ->stacked(),

                Tables\Columns\ImageColumn::make('photo')
                    ->label('Fotos')
                    ->stacked(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
                Tables\Actions\Action::make('descargar_expediente')
                    ->label('Descargar')
                    ->color('info')
                    ->action(function (MedicalRecord $record) {
                        return static::descargarExpediente($record);
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicalRecords::route('/'),
            'create' => Pages\CreateMedicalRecord::route('/create'),
            'edit' => Pages\EditMedicalRecord::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getModelLabel(): string
    {
        return 'Expedientes Medicos';
    }

    public static function descargarExpediente(MedicalRecord $medicalRecord)
    {
        $pdf = Pdf::loadView('expediente', compact('medicalRecord'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        $filename = 'expediente-'.$medicalRecord->patient->name.'-'.now()->format('Y-m-d').'.pdf';

        return response()->streamDownload(
            fn () => print ($pdf->output()),
            $filename
        );
    }
}
