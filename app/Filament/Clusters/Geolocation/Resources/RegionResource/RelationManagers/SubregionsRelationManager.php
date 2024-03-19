<?php

namespace App\Filament\Clusters\Geolocation\Resources\RegionResource\RelationManagers;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\SelectFilter;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Clusters\Geolocation\Resources\SubregionResource;

/**
 * Subregions Relation Manager.
 * 
 * @class SubregionsRelationManager
 * @package App\Filament\Clusters\Geolocation\Resources\RegionResource\RelationManagers
 */
class SubregionsRelationManager extends RelationManager
{
    /**
     * Set relationship.
     */
    protected static string $relationship = 'subregions';

    /**
     * Get title.
     * 
     * @param Model $ownerRecord
     * @param string $pageClass
     * @return string
     */
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans_choice('entities.subregions', 2);
    }

    /**
     * Is read only.
     * 
     * @return bool
     */
    public function isReadOnly(): bool
    {
        return true;
    }

    /**
     * Form configuration.
     * 
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form->schema([]);
    }

    /**
     * Table configuration.
     * 
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->paginated([7, 10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(7)
            ->recordTitleAttribute('name')
            ->columns(
                SubregionResource::getTableColumns()
            )
            ->filters([
                SelectFilter::make('status')
                    ->label(trans_choice('fields.status', 1))
                    ->options([
                        'active' => trans_choice('fields.active', 1),
                        'inactive' => trans_choice('fields.inactive', 1)
                    ])
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
