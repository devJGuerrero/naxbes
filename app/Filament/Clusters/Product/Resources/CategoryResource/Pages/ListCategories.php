<?php

namespace App\Filament\Clusters\Product\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Product\Resources\CategoryResource;

/**
 * Page List Categories.
 * 
 * @class ListCategories
 * @package App\Filament\Clusters\Product\Resources\CategoryResource\Pages
 */
class ListCategories extends ListRecords
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return CategoryResource::class;
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
