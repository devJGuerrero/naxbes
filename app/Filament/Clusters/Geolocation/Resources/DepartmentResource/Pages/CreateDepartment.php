<?php

namespace App\Filament\Clusters\Geolocation\Resources\DepartmentResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Geolocation\Resources\DepartmentResource;

/**
 * Page Create Department.
 * 
 * @class CreateDepartment
 * @package App\Filament\Clusters\Geolocation\Resources\DepartmentResource\Pages
 */
class CreateDepartment extends CreateRecord
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return DepartmentResource::class;
    }
}
