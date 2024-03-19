<?php

namespace App\Filament\Clusters\Parameter\Resources\WalletResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Parameter\Resources\WalletResource;

/**
 * Page Edit Wallet.
 * 
 * @class EditWallet
 * @package App\Filament\Clusters\Parameter\Resources\WalletResource\Pages
 */
class EditWallet extends EditRecord
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
            Actions\DeleteAction::make(),
        ];
    }
}
