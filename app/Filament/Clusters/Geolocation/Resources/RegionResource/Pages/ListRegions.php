<?php

namespace App\Filament\Clusters\Geolocation\Resources\RegionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Geolocation\Resources\RegionResource;

/**
 * Page List Regions.
 * 
 * @class ListRegions
 * @package App\Filament\Clusters\Geolocation\Resources\RegionResource\Pages
 */
class ListRegions extends ListRecords
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return RegionResource::class;
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
