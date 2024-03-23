<?php

namespace App\Filament\Clusters\Crm\Resources\CustomerResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Exports\CustomerExporter;
use App\Filament\Clusters\Crm\Resources\CustomerResource;

/**
 * Page List Customers.
 * 
 * @class ListCustomers
 * @package App\Filament\Clusters\Crm\Resources\CustomerResource\Pages
 */
class ListCustomers extends ListRecords
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

    /**
     * Get header actions.
     * 
     * @return array
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->exporter(CustomerExporter::class)
                ->modelLabel(
                    trans_choice('entities.customers', 2)
                ),
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
            null     => Tab::make(trans_choice('messages.all',  1)),
            'male'   => Tab::make(trans_choice('fields.male',   1))->query(fn (Builder $query) => $query->where('genre', 'male')),
            'female' => Tab::make(trans_choice('fields.female', 1))->query(fn (Builder $query) => $query->where('genre', 'female')),
            'other'  => Tab::make(trans_choice('fields.other',  1))->query(fn (Builder $query) => $query->where('genre', 'other')),
        ];
    }
}
