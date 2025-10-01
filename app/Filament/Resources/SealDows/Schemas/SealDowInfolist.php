<?php

namespace App\Filament\Resources\SealDows\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SealDowInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('code'),
                TextEntry::make('product_name'),
                TextEntry::make('batch_number'),
                TextEntry::make('manufacture_date')
                    ->date(),
                TextEntry::make('expiry_date')
                    ->date(),
                TextEntry::make('manufacturing_site'),
                TextEntry::make('repacking_site'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
