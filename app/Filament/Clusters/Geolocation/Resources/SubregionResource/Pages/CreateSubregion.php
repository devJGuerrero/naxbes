<?php

namespace App\Filament\Clusters\Geolocation\Resources\SubregionResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Geolocation\Resources\SubregionResource;

/**
 * Page Create Subregion.
 * 
 * @class CreateSubregion
 * @package App\Filament\Clusters\Geolocation\Resources\SubregionResource\Pages
 */
class CreateSubregion extends CreateRecord
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return SubregionResource::class;
    }
}
