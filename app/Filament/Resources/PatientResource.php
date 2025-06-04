<?php

namespace App\Filament\Resources;

use App\Enums\GenderEnum;
use App\Enums\MaritalStatusEnum;
use App\Filament\Resources\PatientResource\Pages;
use App\Models\Patient;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $slug = 'patients';

    protected static ?string $navigationLabel = 'Pacientes';

    protected static ?string $navigationIcon = 'heroicon-m-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),

                TextInput::make('surname')
                    ->label('Apellido')
                    ->required(),

                DatePicker::make('birth_at')
                    ->label('Fecha de Nacimiento')
                    ->maxDate(now())
                    ->required(),

                TextInput::make('phone')
                    ->label('Telefono')
                    ->tel()
                    ->telRegex('/^\d{8}$/')
                    ->required(),

                Select::make('gender')
                    ->label('Genero')
                    ->options(GenderEnum::class)
                    ->required(),

                Select::make('marital_status')
                    ->label('Estado Civil')
                    ->options(MaritalStatusEnum::class)
                    ->default('single'),

                TextInput::make('email')
                    ->email()
                    ->required(),

                TextInput::make('allergies')
                    ->label('Alergias')
                    ->default('No'),

                TextInput::make('address')
                    ->label('Direccion')
                    ->default('Ciudad'),

                Placeholder::make('created_at')
                    ->label('Creado')
                    ->content(fn (?Patient $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Modificado')
                    ->content(fn (?Patient $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('surname')
                    ->label('Apellido'),

                TextColumn::make('birth_at')
                    ->label('Fecha de Nacimiento')
                    ->date(),

                TextColumn::make('phone')
                    ->label('Telefono'),

                TextColumn::make('gender')
                    ->label('Genero')
                    ->badge(),

                TextColumn::make('marital_status')
                    ->label('Estado Civil')
                    ->badge(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('allergies')
                    ->label('Alergias'),

                TextColumn::make('address')
                    ->label('Direccion'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getModelLabel(): string
    {
        return 'Pacientes';
    }
}
