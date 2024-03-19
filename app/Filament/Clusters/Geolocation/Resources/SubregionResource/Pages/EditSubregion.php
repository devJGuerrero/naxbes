<?php

namespace App\Filament\Clusters\Geolocation\Resources\SubregionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Geolocation\Resources\SubregionResource;

/**
 * Page Edit Subregion.
 * 
 * @class EditSubregion
 * @package App\Filament\Clusters\Geolocation\Resources\SubregionResource\Pages
 */
class EditSubregion extends EditRecord
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
