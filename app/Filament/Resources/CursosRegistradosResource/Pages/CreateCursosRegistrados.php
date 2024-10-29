<?php

namespace App\Filament\Resources\CursosRegistradosResource\Pages;

use App\Filament\Resources\CursosRegistradosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCursosRegistrados extends CreateRecord
{
    protected static string $resource = CursosRegistradosResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
