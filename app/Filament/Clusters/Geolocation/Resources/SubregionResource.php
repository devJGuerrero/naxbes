<?php

namespace App\Filament\Clusters\Geolocation\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Subregion;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use App\Filament\Clusters\Geolocation;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use App\Filament\Clusters\Geolocation\Resources\SubregionResource\Pages;
use App\Filament\Clusters\Geolocation\Resources\SubregionResource\RelationManagers\CountriesRelationManager;

/**
 * Subregion Entity.
 * This resource allows you to manage the global CRUD configuration.
 * 
 * @class SubregionResource
 * @package App\Filament\Clusters\Geolocation\Resources
 */
class SubregionResource extends Resource
{
    /**
     * Get cluster.
     * 
     * @return string
     */
    public static function getCluster(): ?string
    {
        return Geolocation::class;
    }

    /**
     * Get entity model.
     * 
     * @return string
     */
    public static function getModel(): string
    {
        return Subregion::class;
    }

    /**
     * Get label.
     * 
     * @return string
     */
    public static function getLabel(): ?string
    {
        return trans_choice('entities.subregions', 2);
    }

    /**
     * Get navigation icon.
     * 
     * @return string
     */
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-minus';
    }

    /**
     * Get navigation sort.
     * 
     * @return int
     */
    public static function getNavigationSort(): ?int
    {
        return 5;
    }

    /**
     * Can create.
     * 
     * @return bool
     */
    public static function canCreate(): bool
    {
        return false;
    }

    /**
     * Can delete.
     * 
     * @return bool
     */
    public static function canDelete(Model $record): bool
    {
        return false;
    }

    /**
     * Can delete any.
     * 
     * @return bool
     */
    public static function canDeleteAny(): bool
    {
        return false;
    }

    /**
     * Get form.
     * 
     * @return array
     */
    public static function getForm(): array
    {
        return [
            Group::make()
                ->schema([
                    Section::make()
                        ->schema([
                            Group::make()
                                ->schema([
                                    Select::make('region_id')
                                        ->label(trans_choice('fields.region', 1))
                                        ->relationship('region', 'name')
                                        ->disabled(),
                                    TextInput::make('name')
                                        ->label(trans_choice('fields.subregion', 1))
                                        ->unique(ignoreRecord: true)
                                        ->disabled(),
                                ])
                                ->columns(2)
                        ]),
                ])
                ->columnSpan(['lg' => 3]),
            Group::make()
                ->schema([
                    Section::make()
                        ->schema([
                            Toggle::make('status')
                                ->label(trans_choice('fields.status', 1))
                                ->helperText(trans_choice('messages.helper_text_status', 1))
                                ->required(),
                        ]),
                    Section::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->label(trans_choice('fields.created_at', 1))
                                ->content(fn (Subregion $record): ?string => $record->created_at?->diffForHumans()),
                            Placeholder::make('updated_at')
                                ->label(trans_choice('fields.last_modified_on', 1))
                                ->content(fn (Subregion $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Subregion $record) => $record === null),
                ])
                ->columnSpan(['lg' => 1]),
        ];
    }

    /**
     * Get table columns.
     * 
     * @return array
     */
    public static function getTableColumns(): array
    {
        return [
            TextColumn::make('region.name')
                ->label(trans_choice('fields.region', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('name')
                ->label(trans_choice('fields.subregion', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('status')
                ->label(trans_choice('fields.status', 1))
                ->badge()
                ->toggleable()
                ->color(fn (string $state): string => $state ? 'success' : 'gray')
                ->formatStateUsing(fn (string $state): string => $state ? trans_choice('fields.active', 1) : trans_choice('fields.inactive', 1)),
        ];
    }

    /**
     * Get table filter.
     * 
     * @return array
     */
    public static function getTableFilter(): array
    {
        return [
            SelectFilter::make('region_id')
                ->label(trans_choice('fields.region', 1))
                ->native(false)
                ->searchable()
                ->preload()
                ->relationship('region', 'name'),
            SelectFilter::make('status')
                ->label(trans_choice('fields.status', 1))
                ->native(false)
                ->options([
                    true => trans_choice('fields.active', 1),
                    false => trans_choice('fields.inactive', 1)
                ])
        ];
    }

    /**
     * Form configuration.
     * 
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form->schema(static::getForm())->columns(4);
    }

    /**
     * Table configuration.
     * 
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->paginated([7, 10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(7)
            ->columns(
                static::getTableColumns()
            )
            ->filters(
                static::getTableFilter()
            )
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Get relations.
     * 
     * @return array
     */
    public static function getRelations(): array
    {
        return [
            CountriesRelationManager::class,
        ];
    }

    /**
     * Get pages.
     * 
     * @retrun array
     */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSubregions::route('/'),
            'create' => Pages\CreateSubregion::route('/create'),
            'edit'   => Pages\EditSubregion::route('/{record}/edit'),
        ];
    }
}
