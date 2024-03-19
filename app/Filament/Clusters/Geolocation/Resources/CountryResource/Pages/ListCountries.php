<?php

namespace App\Filament\Clusters\Geolocation\Resources\CountryResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Exports\CountryExporter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Clusters\Geolocation\Resources\CountryResource;

/**
 * Page List Countries.
 * 
 * @class ListCountries
 * @package App\Filament\Resources\CountryResource\Pages
 */
class ListCountries extends ListRecords
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return CountryResource::class;
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
                ->exporter(CountryExporter::class)
                ->modelLabel(
                    trans_choice('entities.countries', 2)
                )
                ->label(
                    trans_choice('messages.action_export_form', 1, [
                        'entity' => trans_choice('entities.countries', 1)
                    ])
                ),
            Actions\CreateAction::make()
                ->label(
                    trans_choice('messages.action_create_form', 1, [
                        'entity' => trans_choice('entities.countries', 1)
                    ])
                ),
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
            'asia' => Tab::make(trans_choice('fields.asia', 1))->query(fn (Builder $query) => $query->where('region_id', 1)),
            'europa' => Tab::make(trans_choice('fields.europa', 1))->query(fn (Builder $query) => $query->where('region_id', 2)),
            'africa' => Tab::make(trans_choice('fields.africa', 1))->query(fn (Builder $query) => $query->where('region_id', 3)),
            'oceania' => Tab::make(trans_choice('fields.oceania', 1))->query(fn (Builder $query) => $query->where('region_id', 4)),
            'america' => Tab::make(trans_choice('fields.america', 1))->query(fn (Builder $query) => $query->where('region_id', 5)),
            'antarctica' => Tab::make(trans_choice('fields.antarctica', 1))->query(fn (Builder $query) => $query->where('region_id', 6)),
        ];
    }
}
