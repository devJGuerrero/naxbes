<?php

namespace App\Filament\Clusters\Geolocation\Resources\SubregionResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Clusters\Geolocation\Resources\SubregionResource;

/**
 * Page List Subregions.
 * 
 * @class ListSubregions
 * @package App\Filament\Clusters\Geolocation\Resources\SubregionResource\Pages
 */
class ListSubregions extends ListRecords
{
    /**
     * Get resource.
     * 
     * @return string
     */
    public static function getResource(): string
    {
        return SubregionResource::class;
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
            'asia' => Tab::make(trans_choice('fields.asia', 1))->query(fn (Builder $query) => $query->where('region_id', 1)),
            'europa' => Tab::make(trans_choice('fields.europa', 1))->query(fn (Builder $query) => $query->where('region_id', 2)),
            'africa' => Tab::make(trans_choice('fields.africa', 1))->query(fn (Builder $query) => $query->where('region_id', 3)),
            'oceania' => Tab::make(trans_choice('fields.oceania', 1))->query(fn (Builder $query) => $query->where('region_id', 4)),
            'america' => Tab::make(trans_choice('fields.america', 1))->query(fn (Builder $query) => $query->where('region_id', 5)),
            'antarctica' => Tab::make(trans_choice('fields.antarctica', 1))->query(fn (Builder $query) => $query->where('region_id', 6)),
        ];
    }
}
