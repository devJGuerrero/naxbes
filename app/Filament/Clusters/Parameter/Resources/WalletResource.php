<?php

namespace App\Filament\Clusters\Parameter\Resources;

use Filament\Tables;
use App\Models\Wallet;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Parameter;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Illuminate\Validation\Rules\Unique;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use App\Filament\Clusters\Parameter\Resources\WalletResource\Pages;
use App\Filament\Shared\RelationManagers\PaymentMethodsRelationManager;

/**
 * Wallet Entity.
 * This resource allows you to manage the global CRUD configuration.
 * 
 * @class WalletResource
 * @package App\Filament\Clusters\Parameter\Resources
 */
class WalletResource extends Resource
{
    /**
     * Get cluster.
     * 
     * @return string
     */
    public static function getCluster(): ?string
    {
        return Parameter::class;
    }

    /**
     * Get entity model.
     * 
     * @return string
     */
    public static function getModel(): string
    {
        return Wallet::class;
    }

    /**
     * Get label.
     * 
     * @return string
     */
    public static function getLabel(): ?string
    {
        return trans_choice('entities.wallets', 2);
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
                                    Select::make('country_id')
                                        ->label(trans_choice('fields.country', 1))
                                        ->native(false)
                                        ->preload()
                                        ->searchable()
                                        ->relationship('country', 'name')
                                        ->optionsLimit(250)
                                        ->required(),
                                    TextInput::make('name')
                                        ->label(trans_choice('fields.wallet', 1))
                                        ->minLength(3)
                                        ->maxLength(255)
                                        ->required()
                                        ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule, Get $get) {
                                            return $rule->where('country_id', $get('country_id'));
                                        }),
                                ])->columns(2),
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
                                ->default(true)
                                ->required(),
                        ]),
                    Section::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->label(trans_choice('fields.created_at', 1))
                                ->content(fn (Wallet $record): ?string => $record->created_at?->diffForHumans()),
                            Placeholder::make('updated_at')
                                ->label(trans_choice('fields.last_modified_on', 1))
                                ->content(fn (Wallet $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Wallet $record) => $record === null),
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
            TextColumn::make('country.name')
                ->label(trans_choice('fields.country', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('name')
                ->label(trans_choice('fields.wallet', 1))
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
            SelectFilter::make('country_id')
                ->label(trans_choice('fields.country', 1))
                ->native(false)
                ->searchable()
                ->optionsLimit(250)
                ->preload()
                ->relationship('country', 'name'),
            SelectFilter::make('status')
                ->label(trans_choice('fields.status', 1))
                ->native(false)
                ->options([
                    true => trans_choice('fields.active', 1),
                    false => trans_choice('fields.inactive', 1)
                ]),
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
            PaymentMethodsRelationManager::class,
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
            'index'  => Pages\ListWallets::route('/'),
            'create' => Pages\CreateWallet::route('/create'),
            'edit'   => Pages\EditWallet::route('/{record}/edit'),
        ];
    }
}
