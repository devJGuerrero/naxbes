<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Exports\CompanyExporter;
use App\Filament\Resources\CompanyResource;

/**
 * Page List Companies.
 * 
 * @class ListCompanies
 * @package App\Filament\Resources\CompanyResource\Pages
 */
class ListCompanies extends ListRecords
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return CompanyResource::class;
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
                ->exporter(CompanyExporter::class)
                ->modelLabel(
                    trans_choice('entities.companies', 2)
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
            null             => Tab::make(trans_choice('messages.all', 1)),
            'trade'          => Tab::make(trans_choice('fields.trade', 1))->query(fn (Builder $query) => $query->where('economic_activity', 'trade')),
            'industry'       => Tab::make(trans_choice('fields.industry', 1))->query(fn (Builder $query) => $query->where('economic_activity', 'industry')),
            'transport'      => Tab::make(trans_choice('fields.transport', 1))->query(fn (Builder $query) => $query->where('economic_activity', 'transport')),
            'other_services' => Tab::make(trans_choice('fields.other_services', 1))->query(fn (Builder $query) => $query->where('economic_activity', 'other_services')),
        ];
    }
}
