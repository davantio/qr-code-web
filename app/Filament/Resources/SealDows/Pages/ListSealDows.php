<?php

namespace App\Filament\Resources\SealDows\Pages;

use App\Filament\Resources\SealDows\SealDowResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSealDows extends ListRecords
{
    protected static string $resource = SealDowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
