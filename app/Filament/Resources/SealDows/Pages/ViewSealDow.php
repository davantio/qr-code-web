<?php

namespace App\Filament\Resources\SealDows\Pages;

use App\Filament\Resources\SealDows\SealDowResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSealDow extends ViewRecord
{
    protected static string $resource = SealDowResource::class;

    // protected static string $view = 'filament.resources.seal-dows.pages.view-qr-code';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
