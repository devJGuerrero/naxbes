<?php

namespace App\Filament\Clusters\Geolocation\Resources\CityResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Geolocation\Resources\CityResource;

/**
 * Page Create City.
 * 
 * @class CreateCity
 * @package App\Filament\Clusters\Geolocation\Resources\CityResource\Pages
 */
class CreateCity extends CreateRecord
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
}
