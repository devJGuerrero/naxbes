<?php

namespace App\Filament\Clusters\Geolocation\Resources\CityResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Geolocation\Resources\CityResource;

/**
 * Page List Cities.
 * 
 * @class ListCities
 * @package App\Filament\Clusters\Geolocation\Resources\CityResource\Pages
 */
class ListCities extends ListRecords
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return CityResource::class;
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
