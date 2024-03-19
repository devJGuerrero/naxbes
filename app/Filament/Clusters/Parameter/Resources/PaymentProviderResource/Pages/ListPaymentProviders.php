<?php

namespace App\Filament\Clusters\Parameter\Resources\PaymentProviderResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Parameter\Resources\PaymentProviderResource;

/**
 * Page List PaymentProviders.
 * 
 * @class ListPaymentProviders
 * @package App\Filament\Clusters\Parameter\Resources\PaymentProviderResource\Pages
 */
class ListPaymentProviders extends ListRecords
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
            Actions\CreateAction::make(),
        ];
    }

    /**
     * Get tabs.
     * 
     * @return array
     */
    public function getTabs(): array
    {
        return [
            null => Tab::make(trans_choice('messages.all', 1)),
            'bank' => Tab::make(trans_choice('fields.bank', 1))->query(fn (Builder $query) => $query->where('type', 'bank')),
            'wallet' => Tab::make(trans_choice('fields.wallet', 1))->query(fn (Builder $query) => $query->where('type', 'wallet')),
            'other' => Tab::make(trans_choice('fields.other', 1))->query(fn (Builder $query) => $query->where('type', 'other')),
        ];
    }
}
