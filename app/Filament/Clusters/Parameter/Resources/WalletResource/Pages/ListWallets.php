<?php

namespace App\Filament\Clusters\Parameter\Resources\WalletResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Parameter\Resources\WalletResource;

/**
 * Page List Wallets.
 * 
 * @class ListWallets
 * @package App\Filament\Clusters\Parameter\Resources\WalletResource\Pages
 */
class ListWallets extends ListRecords
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return WalletResource::class;
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
