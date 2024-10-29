<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CursosRegistradosResource\Pages;
use App\Filament\Resources\CursosRegistradosResource\RelationManagers;
use App\Models\CursosRegistrados;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CursosRegistradosResource extends Resource
{
    protected static ?string $model = CursosRegistrados::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('fecha_matricula')
                    ->required(),
                Forms\Components\TextInput::make('grupo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nivel')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('fecha_fin_curso'),
                Forms\Components\TextInput::make('definitiva')
                    ->numeric(),
                Forms\Components\Toggle::make('aprobado')
                    ->required(),
                Forms\Components\Toggle::make('aplazado')
                    ->required(),
                Forms\Components\TextInput::make('curso_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('estudiante_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha_matricula')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grupo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nivel')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_fin_curso')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('definitiva')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('aprobado')
                    ->boolean(),
                Tables\Columns\IconColumn::make('aplazado')
                    ->boolean(),
                Tables\Columns\TextColumn::make('curso_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estudiante_id')
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
            'index' => Pages\ListCursosRegistrados::route('/'),
            'create' => Pages\CreateCursosRegistrados::route('/create'),
            'edit' => Pages\EditCursosRegistrados::route('/{record}/edit'),
        ];
    }
}
