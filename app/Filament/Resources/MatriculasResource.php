<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatriculasResource\Pages;
use App\Filament\Resources\MatriculasResource\RelationManagers;
use App\Models\Matriculas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MatriculasResource extends Resource
{
    protected static ?string $model = Matriculas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('fecha_matriculado')
                    ->required(),
                Forms\Components\Select::make('curso_id')
                    ->relationship('curso', 'id')
                    ->required(),
                Forms\Components\Select::make('estudiante_id')
                    ->relationship('estudiante', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha_matriculado')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('curso.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estudiante.name')
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
            'index' => Pages\ListMatriculas::route('/'),
            'create' => Pages\CreateMatriculas::route('/create'),
            'edit' => Pages\EditMatriculas::route('/{record}/edit'),
        ];
    }
}
