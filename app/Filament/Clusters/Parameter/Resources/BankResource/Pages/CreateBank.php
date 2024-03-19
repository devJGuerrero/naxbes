<?php

namespace App\Filament\Clusters\Parameter\Resources\BankResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Parameter\Resources\BankResource;

/**
 * Page Create Bank.
 * 
 * @class CreateBank
 * @package App\Filament\Clusters\Parameter\Resources\BankResource\Pages
 */
class CreateBank extends CreateRecord
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return BankResource::class;
    }
}
