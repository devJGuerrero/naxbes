<?php

namespace App\Filament\Clusters\Geolocation\Resources\DepartmentResource\RelationManagers;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Clusters\Geolocation\Resources\CityResource;

/**
 * Cities Relation Manager.
 * 
 * @class CitiesRelationManager
 * @package App\Filament\Clusters\Geolocation\Resources\DepartmentResource\RelationManagers
 */
class CitiesRelationManager extends RelationManager
{
    /**
     * Set relationship.
     */
    protected static string $relationship = 'cities';

    /**
     * Get title.
     * 
     * @param Model $ownerRecord
     * @param string $pageClass
     * @return string
     */
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans_choice('entities.cities', 2);
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
                CityResource::getTableColumns()
            )
            ->filters(
                CityResource::getTableFilter(
                    $this->ownerRecord->country_id,
                    $this->ownerRecord->id
                )
            )
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
