<?php

namespace App\Filament\Clusters\Product\Resources\BrandResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Product\Resources\BrandResource;

/**
 * Page List Brands.
 * 
 * @class ListBrands
 * @package App\Filament\Clusters\Product\Resources\BrandResource\Pages
 */
class ListBrands extends ListRecords
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return BrandResource::class;
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
