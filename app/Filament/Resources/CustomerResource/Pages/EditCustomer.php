<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CustomerResource;

/**
 * Page Edit Customer.
 * 
 * @class EditCustomer
 * @package App\Filament\Resources\CustomerResource\Pages
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
