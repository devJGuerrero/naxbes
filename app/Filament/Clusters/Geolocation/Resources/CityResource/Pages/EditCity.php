<?php

namespace App\Filament\Clusters\Geolocation\Resources\CityResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Geolocation\Resources\CityResource;

/**
 * Page Edit City.
 * 
 * @class EditCity
 * @package App\Filament\Clusters\Geolocation\Resources\CityResource\Pages
 */
class EditCity extends EditRecord
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
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
