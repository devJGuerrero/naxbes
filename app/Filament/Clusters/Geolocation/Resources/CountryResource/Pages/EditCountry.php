<?php

namespace App\Filament\Clusters\Geolocation\Resources\CountryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Geolocation\Resources\CountryResource;

/**
 * Page Edit Country.
 * 
 * @class EditCountry
 * @package App\Filament\Resources\CountryResource\Pages
 */
class EditCountry extends EditRecord
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return CountryResource::class;
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
