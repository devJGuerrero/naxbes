<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CompanyResource;

/**
 * Page Create Company.
 * 
 * @class CreateCompany
 * @package App\Filament\Resources\CompanyResource\Pages
 */
class CreateCompany extends CreateRecord
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return CompanyResource::class;
    }
}
