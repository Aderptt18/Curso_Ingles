<?php

namespace App\Filament\Resources\CursosRegistradosResource\Pages;

use App\Filament\Resources\CursosRegistradosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCursosRegistrados extends EditRecord
{
    protected static string $resource = CursosRegistradosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
