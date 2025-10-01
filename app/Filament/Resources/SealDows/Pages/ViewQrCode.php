<?php

namespace App\Filament\Resources\SealDows\Pages;

use App\Filament\Resources\SealDows\SealDowResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class ViewQrCode extends Page
{
    use InteractsWithRecord;

    protected static string $resource = SealDowResource::class;

    protected string $view = 'filament.resources.seal-dows.pages.view-qr-code';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
