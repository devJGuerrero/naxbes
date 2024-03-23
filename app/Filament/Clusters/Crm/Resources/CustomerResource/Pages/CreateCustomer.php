<?php

namespace App\Filament\Clusters\Crm\Resources\CustomerResource\Pages;


use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Crm\Resources\CustomerResource;

/**
 * Page Create Customer.
 * 
 * @class CreateCustomer
 * @package App\Filament\Clusters\Crm\Resources\CustomerResource\Pages
 */
class CreateCustomer extends CreateRecord
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
}
