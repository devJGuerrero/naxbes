<?php

namespace App\Filament\Clusters\Crm\Resources\CompanyResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Crm\Resources\CompanyResource;

/**
 * Page Edit Company.
 * 
 * @class EditCompany
 * @package App\Filament\Clusters\Crm\Resources\CompanyResource\Pages
 */
class EditCompany extends EditRecord
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
