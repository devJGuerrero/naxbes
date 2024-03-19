<?php

namespace App\Filament\Clusters\Parameter\Resources\CurrencyResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Parameter\Resources\CurrencyResource;

/**
 * Page List Currencies.
 * 
 * @class ListCurrencies
 * @package App\Filament\Clusters\Parameter\Resources\CurrencyResource\Pages
 */
class ListCurrencies extends ListRecords
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
            Actions\CreateAction::make(),
        ];
    }
}
