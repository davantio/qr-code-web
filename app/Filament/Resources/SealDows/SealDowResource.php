<?php

namespace App\Filament\Resources\SealDows;

use App\Filament\Resources\SealDows\Pages\CreateSealDow;
use App\Filament\Resources\SealDows\Pages\EditSealDow;
use App\Filament\Resources\SealDows\Pages\ListSealDows;
use App\Filament\Resources\SealDows\Pages\ViewQrCode;
use App\Filament\Resources\SealDows\Pages\ViewSealDow;
use App\Filament\Resources\SealDows\Schemas\SealDowForm;
use App\Filament\Resources\SealDows\Schemas\SealDowInfolist;
use App\Filament\Resources\SealDows\Tables\SealDowsTable;
use App\Models\SealDow;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SealDowResource extends Resource
{
    protected static ?string $model = SealDow::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SealDowForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SealDowInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SealDowsTable::configure($table);
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
            'index' => ListSealDows::route('/'),
            'create' => CreateSealDow::route('/create'),
            'view-qr-code' => ViewQrCode::route('/{record}/view-qr-code'),
            'view' => ViewSealDow::route('/{record}'),
            'edit' => EditSealDow::route('/{record}/edit'),
        ];
    }
}
