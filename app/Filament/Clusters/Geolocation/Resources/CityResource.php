<?php

namespace App\Filament\Clusters\Geolocation\Resources;

use Filament\Tables;
use App\Models\City;
use App\Models\Country;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Models\Department;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Filters\Indicator;
use Filament\Forms\Components\Section;
use App\Filament\Clusters\Geolocation;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\Clusters\Geolocation\Resources\CityResource\Pages;

/**
 * City Entity.
 * This resource allows you to manage the global CRUD configuration.
 * 
 * @class CityResource
 * @package App\Filament\Clusters\Geolocation\Resources
 */
class CityResource extends Resource
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
        return City::class;
    }

    /**
     * Get label.
     * 
     * @return string
     */
    public static function getLabel(): ?string
    {
        return trans_choice('entities.cities', 2);
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
        return 3;
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
                                    Select::make('country_id')
                                        ->label(trans_choice('fields.country', 1))
                                        ->relationship('department.country', 'name', function (Builder $query, Get $get, Set $set) {
                                            $department = Department::query()->where('id', $get('department_id'))->first();
                                            if ($department) {
                                                $set('country_id', $department->country_id);
                                            }
                                            return $query;
                                        })
                                        ->disabled(),
                                    Select::make('department_id')
                                        ->label(trans_choice('fields.department', 1))
                                        ->relationship('department', 'name')
                                        ->disabled(),
                                    TextInput::make('name')
                                        ->label(trans_choice('fields.city', 1))
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
                                ->content(fn (City $record): ?string => $record->created_at?->diffForHumans()),
                            Placeholder::make('updated_at')
                                ->label(trans_choice('fields.last_modified_on', 1))
                                ->content(fn (City $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?City $record) => $record === null),
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
                ->label(trans_choice('fields.city', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('department.country.name')
                ->label(trans_choice('fields.country', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('department.name')
                ->label(trans_choice('fields.department', 1))
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
    public static function getTableFilter(int $countryId = null, int $departmentId = null): array
    {
        return [
            Filter::make('country')
                ->form([
                    Select::make('country_id')
                        ->label(trans_choice('fields.country', 1))
                        ->native(false)
                        ->relationship('department.country', 'name')
                        ->live()
                        ->default($countryId)
                        ->disabled($countryId ? true : false)
                        ->searchable()
                        ->preload()
                        ->optionsLimit(250)
                        ->afterStateUpdated(
                            fn (Set $set) => $set('department_id', null)
                        )
                        ->required(),
                    Select::make('department_id')
                        ->label(trans_choice('fields.department', 1))
                        ->native(false)
                        ->options(
                            fn (Get $get): Collection => Department::query()
                                ->where('country_id', $get('country_id'))
                                ->pluck('name', 'id')
                        )
                        ->live()
                        ->default($departmentId)
                        ->disabled($departmentId ? true : false)
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
                    if ($data['country_id'] ?? null) {
                        $indicators[] = Indicator::make(
                            trans_choice('fields.country', 1) . ': ' . Country::query()
                                ->find($data['country_id'])->name ?? ''
                        );
                    }
                    if ($data['department_id'] ?? null) {
                        $indicators[] = Indicator::make(
                            trans_choice('fields.department', 1) . ': ' . Department::query()
                                ->find($data['department_id'])->name ?? ''
                        );
                    }
                    if (in_array($data['status'] ?? null, [0, 1]) and !is_null($data['status'])) {
                        $indicators[] = Indicator::make(
                            trans_choice('fields.status', 1) . ': ' . ($data['status'] === 'active' ? trans_choice('fields.active', 1) : trans_choice('fields.inactive', 1))
                        );
                    }
                    return $indicators;
                })
                ->query(function (Builder $query, array $data) {
                    $query->when($data['country_id'], function (Builder $query) use ($data) {
                        $query->whereHas('department', function (Builder $query) use ($data) {
                            $query->where('country_id', $data['country_id']);
                        });
                    });
                    $query->when($data['department_id'], function (Builder $query) use ($data) {
                        $query->whereHas('department', function (Builder $query) use ($data) {
                            $query->where('department_id', $data['department_id']);
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
        return [];
    }

    /**
     * Get pages.
     * 
     * @retrun array
     */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit'   => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
