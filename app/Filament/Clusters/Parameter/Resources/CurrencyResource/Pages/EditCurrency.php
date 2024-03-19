<?php

namespace App\Filament\Clusters\Parameter\Resources\CurrencyResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Parameter\Resources\CurrencyResource;

/**
 * Page Edit Currency.
 * 
 * @class EditCurrency
 * @package App\Filament\Clusters\Parameter\Resources\CurrencyResource\Pages
 */
class EditCurrency extends EditRecord
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return CurrencyResource::class;
    }

    /**
     * Get header actions.
     * 
     * @return array
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
