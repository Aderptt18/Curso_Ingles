<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CursosResource\Pages;
use App\Filament\Resources\CursosResource\RelationManagers;
use App\Models\Cursos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CursosResource extends Resource
{
    protected static ?string $model = Cursos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descripcion')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('nivel')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('codigo_interno')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('vigencia')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_inicio')
                    ->required(),
                Forms\Components\DatePicker::make('fecha_final')
                    ->required(),
                Forms\Components\TextInput::make('cupo_máximo')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('docente_id')
                    ->relationship('docente', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nivel')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('codigo_interno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vigencia')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_final')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cupo_máximo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('docente.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCursos::route('/'),
            'create' => Pages\CreateCursos::route('/create'),
            'edit' => Pages\EditCursos::route('/{record}/edit'),
        ];
    }
}
