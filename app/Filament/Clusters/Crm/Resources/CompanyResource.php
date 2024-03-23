<?php

namespace App\Filament\Clusters\Crm\Resources;

use Filament\Tables;
use App\Models\City;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Country;
use App\Models\Company;
use Filament\Forms\Form;
use App\Models\Department;
use Filament\Tables\Table;
use App\Filament\Clusters\Crm;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use App\Enums\CompanyEconomicActivity;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Clusters\Crm\Resources\CompanyResource\Pages;

/**
 * Company Entity.
 * This resource allows you to manage the global CRUD configuration.
 * 
 * @class CompanyResource
 * @package App\Filament\Clusters\Crm\Resources
 */
class CompanyResource extends Resource
{
    /**
     * Get cluster.
     * 
     * @return string
     */
    public static function getCluster(): ?string
    {
        return Crm::class;
    }

    /**
     * Get entity model.
     * 
     * @return string
     */
    public static function getModel(): string
    {
        return Company::class;
    }

    /**
     * Get label.
     * 
     * @return string
     */
    public static function getLabel(): ?string
    {
        return trans_choice('entities.companies', 2);
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
        return 2;
    }

    /**
     * Get record title attribute.
     * 
     * @return string
     */
    public static function getRecordTitleAttribute(): ?string
    {
        return 'name';
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
                                        ->label(trans_choice('fields.company', 1))
                                        ->minLength(3)
                                        ->maxLength(255)
                                        ->unique(ignoreRecord: true)
                                        ->required(),
                                ])->columns(2),
                            Group::make()
                                ->schema([
                                    TextInput::make('nit')
                                        ->label(trans_choice('fields.nit', 1))
                                        ->maxLength(20)
                                        ->unique(ignoreRecord: true)
                                        ->required(),
                                    Group::make()
                                        ->schema([
                                            TextInput::make('phone')
                                                ->label(trans_choice('fields.phone', 1))
                                                ->minLength(5)
                                                ->maxLength(25)
                                                ->tel()
                                                ->unique(ignoreRecord: true)
                                                ->required(),
                                            TextInput::make('fax')
                                                ->label(trans_choice('fields.fax', 1))
                                                ->maxLength(35),
                                        ])
                                        ->columns(2),
                                ])
                                ->columns(2),
                            Group::make()
                                ->schema([
                                    TextInput::make('email')
                                        ->label(trans_choice('fields.email', 1))
                                        ->minLength(5)
                                        ->maxLength(80)
                                        ->email()
                                        ->unique(ignoreRecord: true)
                                        ->required(),
                                    TextInput::make('website')
                                        ->label(trans_choice('fields.website', 1))
                                        ->url()
                                        ->suffixIcon('heroicon-m-globe-alt')
                                        ->maxLength(255),
                                ])
                                ->columns(2),
                        ]),
                    Section::make()
                        ->schema([
                            Group::make()
                                ->schema([
                                    Select::make('country_id')
                                        ->label(trans_choice('fields.country', 1))
                                        ->native(false)
                                        ->live()
                                        ->searchable()
                                        ->preload()
                                        ->optionsLimit(250)
                                        ->relationship('country', 'name', fn (Builder $query) => $query->where('status', true))
                                        ->required()
                                        ->afterStateUpdated(
                                            function (Set $set) {
                                                $set('department_id', null);
                                                $set('city_id', null);
                                            }
                                        ),
                                    Select::make('department_id')
                                        ->label(trans_choice('fields.department', 1))
                                        ->native(false)
                                        ->live()
                                        ->searchable()
                                        ->optionsLimit(250)
                                        ->options(
                                            fn (Get $get): Collection => Department::query()
                                                ->where('country_id', $get('country_id'))
                                                ->where('status', true)
                                                ->pluck('name', 'id')
                                        )
                                        ->required()
                                        ->afterStateUpdated(
                                            function (Set $set) {
                                                $set('city_id', null);
                                            }
                                        ),
                                    Select::make('city_id')
                                        ->label(trans_choice('fields.city', 1))
                                        ->native(false)
                                        ->live()
                                        ->searchable()
                                        ->optionsLimit(950)
                                        ->options(
                                            fn (Get $get): Collection => City::query()
                                                ->where('department_id', $get('department_id'))
                                                ->where('status', true)
                                                ->pluck('name', 'id')
                                        )
                                        ->required(),
                                    TextInput::make('address')
                                        ->label(trans_choice('fields.address', 1))
                                        ->minLength(5)
                                        ->maxLength(255)
                                        ->required(),
                                ])
                                ->columns(2),
                            Group::make()
                                ->schema([
                                    ToggleButtons::make('economic_activity')
                                        ->label(trans_choice('fields.economic_activity', 1))
                                        ->inline()
                                        ->options(CompanyEconomicActivity::class)
                                        ->required(),
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
                                ->content(fn (Company $record): ?string => $record->created_at?->diffForHumans()),
                            Placeholder::make('updated_at')
                                ->label(trans_choice('fields.last_modified_on', 1))
                                ->content(fn (Company $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Company $record) => $record === null),
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
                ->label(trans_choice('fields.company', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('nit')
                ->label(trans_choice('fields.nit', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('country.name')
                ->label(trans_choice('fields.country', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('department.name')
                ->label(trans_choice('fields.department', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('city.name')
                ->label(trans_choice('fields.city', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('economic_activity')
                ->label(trans_choice('fields.economic_activity', 1))
                ->badge(),
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
            Filter::make('country')
                ->form([
                    Select::make('country_id')
                        ->label(trans_choice('fields.country', 1))
                        ->native(false)
                        ->relationship('country', 'name')
                        ->live()
                        ->searchable()
                        ->preload()
                        ->optionsLimit(250)
                        ->afterStateUpdated(
                            function (Set $set) {
                                $set('department_id', null);
                                $set('city_id', null);
                            }
                        )
                        ->required(),
                    Select::make('department_id')
                        ->label(trans_choice('fields.department', 1))
                        ->native(false)
                        ->optionsLimit(250)
                        ->options(
                            fn (Get $get): Collection => Department::query()
                                ->where('country_id', $get('country_id'))
                                ->pluck('name', 'id')
                        )
                        ->live()
                        ->searchable()
                        ->preload()
                        ->required()
                        ->afterStateUpdated(
                            function (Set $set) {
                                $set('city_id', null);
                            }
                        ),
                    Select::make('city_id')
                        ->label(trans_choice('fields.city', 1))
                        ->native(false)
                        ->optionsLimit(950)
                        ->options(
                            fn (Get $get): Collection => City::query()
                                ->where('department_id', $get('department_id'))
                                ->pluck('name', 'id')
                        )
                        ->live()
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
                    if ($data['city_id'] ?? null) {
                        $indicators[] = Indicator::make(
                            trans_choice('fields.city', 1) . ': ' . City::query()
                                ->find($data['city_id'])->name ?? ''
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
                        $query->where('country_id', $data['country_id']);
                    });
                    $query->when($data['department_id'], function (Builder $query) use ($data) {
                        $query->where('department_id', $data['department_id']);
                    });
                    $query->when($data['city_id'], function (Builder $query) use ($data) {
                        $query->where('city_id', $data['city_id']);
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
            'index'  => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit'   => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
