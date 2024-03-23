<?php

namespace App\Filament\Clusters\Product\Resources\BrandResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Product\Resources\BrandResource;

/**
 * Page Create Brand.
 * 
 * @class CreateBrand
 * @package App\Filament\Clusters\Product\Resources\BrandResource\Pages
 */
class CreateBrand extends CreateRecord
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
}
