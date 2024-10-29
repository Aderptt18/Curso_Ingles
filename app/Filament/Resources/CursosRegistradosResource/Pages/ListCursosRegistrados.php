<?php

namespace App\Filament\Resources\CursosRegistradosResource\Pages;

use App\Filament\Resources\CursosRegistradosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCursosRegistrados extends ListRecords
{
    protected static string $resource = CursosRegistradosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
