<?php

namespace App\Filament\Clusters\Geolocation\Resources\RegionResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Geolocation\Resources\RegionResource;

/**
 * Page Create Region.
 * 
 * @class CreateRegion
 * @package App\Filament\Clusters\Geolocation\Resources\RegionResource\Pages
 */
class CreateRegion extends CreateRecord
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
}
