<?php

namespace App\Filament\Clusters\Parameter\Resources\PaymentProviderResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Parameter\Resources\PaymentProviderResource;

/**
 * Page Create PaymentProvider.
 * 
 * @class CreatePaymentProvider
 * @package App\Filament\Clusters\Parameter\Resources\PaymentProviderResource\Pages
 */
class CreatePaymentProvider extends CreateRecord
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
}
