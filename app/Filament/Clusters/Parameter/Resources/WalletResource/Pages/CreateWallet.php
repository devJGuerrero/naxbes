<?php

namespace App\Filament\Clusters\Parameter\Resources\WalletResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Parameter\Resources\WalletResource;

/**
 * Page Create Wallet.
 * 
 * @class CreateWallet
 * @package App\Filament\Clusters\Parameter\Resources\WalletResource\Pages
 */
class CreateWallet extends CreateRecord
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
}
