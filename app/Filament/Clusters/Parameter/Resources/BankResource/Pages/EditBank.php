<?php

namespace App\Filament\Clusters\Parameter\Resources\BankResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Parameter\Resources\BankResource;

/**
 * Page Edit Bank.
 * 
 * @class EditBank
 * @package App\Filament\Clusters\Parameter\Resources\BankResource\Pages
 */
class EditBank extends EditRecord
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
            Actions\DeleteAction::make(),
        ];
    }
}
