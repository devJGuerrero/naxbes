<?php

namespace App\Filament\Clusters\Geolocation\Resources\CountryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Geolocation\Resources\CountryResource;

/**
 * Page Create Country.
 * 
 * @class CreateCountry
 * @package App\Filament\Resources\CountryResource\Pages
 */
class CreateCountry extends CreateRecord
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
}
