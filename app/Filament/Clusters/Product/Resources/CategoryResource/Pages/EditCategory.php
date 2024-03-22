<?php

namespace App\Filament\Clusters\Product\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Product\Resources\CategoryResource;

/**
 * Page Edit Category.
 * 
 * @class EditCategory
 * @package App\Filament\Clusters\Product\Resources\CategoryResource\Pages
 */
class EditCategory extends EditRecord
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
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
