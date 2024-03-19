<?php

namespace App\Filament\Clusters\Parameter\Resources\CurrencyResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Parameter\Resources\CurrencyResource;

/**
 * Page Create Currency.
 * 
 * @class CreateCurrency
 * @package App\Filament\Clusters\Parameter\Resources\CurrencyResource\Pages
 */
class CreateCurrency extends CreateRecord
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
}
