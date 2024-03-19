<?php

namespace App\Filament\Clusters\Geolocation\Resources\RegionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Geolocation\Resources\RegionResource;

/**
 * Page Edit Region.
 * 
 * @class EditRegion
 * @package App\Filament\Clusters\Geolocation\Resources\RegionResource\Pages
 */
class EditRegion extends EditRecord
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
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
