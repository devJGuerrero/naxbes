<?php

namespace App\Filament\Clusters\Parameter\Resources\PaymentProviderResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Clusters\Parameter\Resources\PaymentProviderResource;

/**
 * Page Edit PaymentProvider.
 * 
 * @class EditPaymentProvider
 * @package App\Filament\Clusters\Parameter\Resources\PaymentProviderResource\Pages
 */
class EditPaymentProvider extends EditRecord
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return PaymentProviderResource::class;
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
