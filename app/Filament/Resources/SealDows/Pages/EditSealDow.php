<?php

namespace App\Filament\Resources\SealDows\Pages;

use App\Filament\Resources\SealDows\SealDowResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSealDow extends EditRecord
{
    protected static string $resource = SealDowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
