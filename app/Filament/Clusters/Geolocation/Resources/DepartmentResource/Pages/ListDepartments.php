<?php

namespace App\Filament\Clusters\Geolocation\Resources\DepartmentResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Geolocation\Resources\DepartmentResource;

/**
 * Page List Departments.
 * 
 * @class ListDepartments
 * @package App\Filament\Clusters\Geolocation\Resources\DepartmentResource\Pages
 */
class ListDepartments extends ListRecords
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
