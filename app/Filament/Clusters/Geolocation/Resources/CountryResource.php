<?php

namespace App\Filament\Clusters\Geolocation\Resources;

use Filament\Tables;
use App\Models\Region;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Country;
use Filament\Forms\Form;
use App\Models\Subregion;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use App\Filament\Clusters\Geolocation;
use Filament\Tables\Filters\Indicator;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\Clusters\Geolocation\Resources\CountryResource\Pages;
use App\Filament\Clusters\Geolocation\Resources\CountryResource\RelationManagers\CurrenciesRelationManager;
use App\Filament\Clusters\Geolocation\Resources\CountryResource\RelationManagers\DepartmentsRelationManager;

/**
 * Country Entity.
 * This resource allows you to manage the global CRUD configuration.
 * 
 * @class CountryResource
 * @package App\Filament\Resources
 */
class CountryResource extends Resource
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
        return Country::class;
    }

    /**
     * Get label.
     * 
     * @return string
     */
    public static function getLabel(): ?string
    {
        return trans_choice('entities.countries', 2);
    }

    /**
     * Get navigation badge.
     * 
     * @return string
     */
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
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
        return 1;
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
                                    TextInput::make('name')
                                        ->label(trans_choice('fields.country', 1))
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->minLength(5)
                                        ->maxLength(255),
                                ])
                                ->columns(2),
                            Group::make()
                                ->schema([
                                    Select::make('region_id')
                                        ->label(trans_choice('fields.region', 1))
                                        ->live()
                                        ->native(false)
                                        ->searchable()
                                        ->preload()
                                        ->relationship('region', 'name', fn (Builder $query) => $query->where('status', true))
                                        ->afterStateUpdated(
                                            fn (Set $set) => $set('subregion_id', null)
                                        )
                                        ->required(),
                                    Select::make('subregion_id')
                                        ->label(trans_choice('fields.subregion', 1))
                                        ->live()
                                        ->native(false)
                                        ->searchable()
                                        ->preload()
                                        ->options(
                                            fn (Get $get): Collection => Subregion::query()
                                                ->where('region_id', $get('region_id'))
                                                ->where('status', true)
                                                ->pluck('name', 'id')
                                        )
                                        ->required(),
                                ])
                                ->columns(2),
                            Group::make()
                                ->schema([
                                    Select::make('currency_id')
                                        ->label(trans_choice('fields.currency', 1))
                                        ->native(false)
                                        ->preload()
                                        ->optionsLimit(250)
                                        ->relationship('currency', 'name')
                                        ->required(),
                                    Group::make()
                                        ->schema([
                                            TextInput::make('code')
                                                ->label(trans_choice('fields.code_cca2', 1))
                                                ->required()
                                                ->unique(ignoreRecord: true)
                                                ->maxLength(2),
                                            TextInput::make('phone_code')
                                                ->label(trans_choice('fields.area_code', 1))
                                                ->numeric()
                                                ->required()
                                                ->prefixIcon('heroicon-m-plus'),
                                        ])
                                        ->columns(2)
                                ])
                                ->columns(2),
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
                                ->content(fn (Country $record): ?string => $record->created_at?->diffForHumans()),
                            Placeholder::make('updated_at')
                                ->label(trans_choice('fields.last_modified_on', 1))
                                ->content(fn (Country $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Country $record) => $record === null),
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
            TextColumn::make('name')
                ->label(trans_choice('fields.country', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('region.name')
                ->label(trans_choice('fields.region', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('subregion.name')
                ->label(trans_choice('fields.subregion', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('code')
                ->label(trans_choice('fields.code_cca2', 1))
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
    public static function getTableFilter(int $regionId = null, int $subregionId = null): array
    {
        return [
            Filter::make('country')
                ->form([
                    Select::make('region_id')
                        ->label(trans_choice('fields.region', 1))
                        ->native(false)
                        ->relationship('region', 'name')
                        ->live()
                        ->default($regionId)
                        ->disabled($regionId ? true : false)
                        ->searchable()
                        ->preload()
                        ->optionsLimit(250)
                        ->afterStateUpdated(
                            fn (Set $set) => $set('subregion_id', null)
                        )
                        ->required(),
                    Select::make('subregion_id')
                        ->label(trans_choice('fields.subregion', 1))
                        ->native(false)
                        ->options(
                            fn (Get $get): Collection => Subregion::query()
                                ->where('region_id', $get('region_id'))
                                ->pluck('name', 'id')
                        )
                        ->live()
                        ->default($subregionId)
                        ->disabled($subregionId ? true : false)
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('status')
                        ->label(trans_choice('fields.status', 1))
                        ->native(false)
                        ->options([
                            true => trans_choice('fields.active', 1),
                            false => trans_choice('fields.inactive', 1)
                        ]),
                ])
                ->indicateUsing(function (array $data): array {
                    $indicators = [];
                    if ($data['region_id'] ?? null) {
                        $indicators[] = Indicator::make(
                            trans_choice('fields.region', 1) . ': ' . Region::query()
                                ->find($data['region_id'])->name ?? ''
                        );
                    }
                    if ($data['subregion_id'] ?? null) {
                        $indicators[] = Indicator::make(
                            trans_choice('fields.subregion', 1) . ': ' . Subregion::query()
                                ->find($data['subregion_id'])->name ?? ''
                        );
                    }
                    if (in_array($data['status'] ?? null, [0, 1]) and !is_null($data['status'])) {
                        $indicators[] = Indicator::make(
                            trans_choice('fields.status', 1) . ': ' . ($data['status'] ? trans_choice('fields.active', 1) : trans_choice('fields.inactive', 1))
                        );
                    }
                    return $indicators;
                })
                ->query(function (Builder $query, array $data) {
                    $query->when($data['region_id'], function (Builder $query) use ($data) {
                        $query->whereHas('subregion', function (Builder $query) use ($data) {
                            $query->where('region_id', $data['region_id']);
                        });
                    });
                    $query->when($data['subregion_id'], function (Builder $query) use ($data) {
                        $query->whereHas('subregion', function (Builder $query) use ($data) {
                            $query->where('subregion_id', $data['subregion_id']);
                        });
                    });
                    $query->when(in_array($data['status'] ?? null, [0, 1]) and !is_null($data['status']), function (Builder $query) use ($data) {
                        $query->where('status', $data['status']);
                    });
                }),
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
            CurrenciesRelationManager::class,
            DepartmentsRelationManager::class,
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
            'index'  => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit'   => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
