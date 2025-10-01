<?php

namespace App\Filament\Resources\SealDows\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SealDowForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required()
                    ->maxLength(12)
                    ->default(function () {
                        // 9 digit tetap + 3 digit random
                        $prefix = '586815147'; // Ganti dengan 9 digit yang Anda inginkan
                        $suffix = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
                        return $prefix . $suffix;
                    })
                    ->unique('seal_dows', 'code')
                    ->disabled() // User tidak bisa edit
                    ->dehydrated(), // Pastikan value tetap tersimpan
                TextInput::make('product_name')
                    ->required(),
                TextInput::make('batch_number')
                    ->required(),
                DatePicker::make('manufacture_date')
                    ->required(),
                DatePicker::make('expiry_date')
                    ->required(),
                TextInput::make('manufacturing_site')
                    ->required(),
                TextInput::make('repacking_site')
                    ->required(),
            ]);
    }
}
