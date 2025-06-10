<?php

namespace App\Filament\Resources;

use App\Enums\AppointmentStatusEnum;
use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\URL;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $slug = 'appointments';

    protected static ?string $navigationIcon = 'iconsax-two-calendar-edit';

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('patient.name')
                    ->label(__('Paciente'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('date_at')
                    ->label('Fecha')
                    ->date(),

                TextColumn::make('hour_in')
                    ->label('Hora')
                    ->date(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge(),

                TextColumn::make('reason')
                    ->label('Observaciones'),

                TextColumn::make('status')
                    ->label('Estado de Cita')
                    ->badge(),

            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),

                Action::make('ProcessAction')
                    ->button()
                    ->label('Procesar')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('¿Iniciar esta cita?')
                    ->modalSubheading('Esto marcará la cita como "iniciada".')
                    ->action(function (\App\Models\Appointment $appointment) {
                        $appointment->update(['status' => 'inProgress']);
                        Notification::make()
                            ->title('Cita Iniciada')
                            ->success()
                            ->send();

                        return redirect(AppointmentResource::getUrl('process', ['record' => $appointment]));
                    })
                    ->visible(fn(Model $record): bool => in_array($record->status, [
                        AppointmentStatusEnum::Scheduled,
                        AppointmentStatusEnum::Rescheduled,
                        AppointmentStatusEnum::Confirmed,
                        AppointmentStatusEnum::InProgress,
                    ])),
                Action::make('generateShareLink')
                    ->label('Link cita')
                    ->icon('heroicon-o-share')
                    ->color('success')
                    ->form(function ($record) {

                        $record->confirmations()->updateOrCreate(
                            ['appointment_id' => $record->id],
                            ['link' => $link = URL::signedRoute('appointments.confirmation'),
                                'hash' => url($link)]
                        );

                        return [
                            TextInput::make('generated_link')
                                ->label('Link Generado')
                                ->default($link)
                                ->readOnly()
                        ];
                    })
                    ->modalHeading('Link de Compartir')
                    ->modalSubheading('Copia este link para compartir el recurso')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Cerrar')
                    ->visible(fn(Model $record): bool => in_array($record->status, [
                        AppointmentStatusEnum::Scheduled,
                        AppointmentStatusEnum::Rescheduled,
                        AppointmentStatusEnum::Confirmed,
                        AppointmentStatusEnum::InProgress,
                    ]))
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
            'process' => Pages\ProcessAppointment::route('/{record}/process'),
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
        return 'Citas';
    }
}
