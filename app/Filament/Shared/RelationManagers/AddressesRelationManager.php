<?php

namespace App\Filament\Shared\RelationManagers;

use Filament\Tables;
use App\Models\City;
use App\Models\Address;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Department;
use Filament\Tables\Table;
use App\Enums\AddressSite;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\RelationManagers\RelationManager;

/**
 * Addresses Relation Manager.
 * 
 * @class AddressesRelationManager
 * @package App\Filament\Shared\RelationManagers
 */
class AddressesRelationManager extends RelationManager
{
    /**
     * Get relationship name.
     * 
     * @return string
     */
    public static function getRelationshipName(): string
    {
        return 'addresses';
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
     * Get title.
     * 
     * @param Model $ownerRecord
     * @param string $pageClass
     * @return string
     */
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans_choice('entities.addresses', 2);
    }

    /**
     * Form configuration.
     * 
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
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
                                TextInput::make('zip')
                                    ->label(trans_choice('fields.zip', 1))
                                    ->required()
                                    ->minLength(3)
                                    ->maxLength(25),
                            ])->columns(2),
                        Group::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label(trans_choice('fields.address', 1))
                                    ->required()
                                    ->minLength(5)
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columnSpan(['lg' => 3]),
                Group::make()
                    ->schema([
                        ToggleButtons::make('site')
                            ->label(trans_choice('fields.site', 1))
                            ->inline()
                            ->options(AddressSite::class)
                            ->required(),
                        Group::make()
                            ->schema([
                                Placeholder::make('created_at')
                                    ->label(trans_choice('fields.created_at', 1))
                                    ->content(fn (Address $record): ?string => $record->pivot->created_at?->diffForHumans()),
                                Placeholder::make('updated_at')
                                    ->label(trans_choice('fields.last_modified_on', 1))
                                    ->content(fn (Address $record): ?string => $record->pivot->updated_at?->diffForHumans()),
                            ])
                            ->columnSpan(['lg' => 1])
                            ->hidden(fn (?Address $record) => $record === null),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(4);
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
            ->modelLabel(trans_choice('fields.address', 1))
            ->columns([
                TextColumn::make('country.name')
                    ->label(trans_choice('fields.country', 1))
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('department.name')
                    ->label(trans_choice('fields.department', 1))
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('city.name')
                    ->label(trans_choice('fields.city', 1))
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('name')
                    ->label(trans_choice('fields.address', 1))
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('zip')
                    ->label(trans_choice('fields.zip', 1))
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('site')
                    ->label(trans_choice('fields.site', 1))
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
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
            'home'   => Tab::make(trans_choice('fields.home',   1))->query(fn (Builder $query) => $query->where('site', 'home')),
            'office' => Tab::make(trans_choice('fields.office', 1))->query(fn (Builder $query) => $query->where('site', 'office')),
            'other'  => Tab::make(trans_choice('fields.other',  1))->query(fn (Builder $query) => $query->where('site', 'other')),
        ];
    }
}
