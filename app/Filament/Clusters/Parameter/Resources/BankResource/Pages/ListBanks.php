<?php

namespace App\Filament\Clusters\Parameter\Resources\BankResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Parameter\Resources\BankResource;

/**
 * Page List Banks.
 * 
 * @class ListBanks
 * @package App\Filament\Clusters\Parameter\Resources\BankResource\Pages
 */
class ListBanks extends ListRecords
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
