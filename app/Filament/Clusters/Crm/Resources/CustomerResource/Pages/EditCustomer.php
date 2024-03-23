<?php

namespace App\Filament\Clusters\Crm\Resources\CustomerResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Crm\Resources\CustomerResource;

/**
 * Page Edit Customer.
 * 
 * @class EditCustomer
 * @package App\Filament\Clusters\Crm\Resources\CustomerResource\Pages
 */
class EditCustomer extends EditRecord
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return CustomerResource::class;
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
