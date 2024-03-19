<?php

namespace App\Filament\Clusters\Geolocation\Resources\DepartmentResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Geolocation\Resources\DepartmentResource;

/**
 * Page Edit Department.
 * 
 * @class EditDepartment
 * @package App\Filament\Clusters\Geolocation\Resources\DepartmentResource\Pages
 */
class EditDepartment extends EditRecord
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
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
