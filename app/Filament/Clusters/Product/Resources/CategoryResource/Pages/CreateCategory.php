<?php

namespace App\Filament\Clusters\Product\Resources\CategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Product\Resources\CategoryResource;

/**
 * Page Create Category.
 * 
 * @class CreateCategory
 * @package App\Filament\Clusters\Product\Resources\CategoryResource\Pages
 */
class CreateCategory extends CreateRecord
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
}
