<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Enums\Genre;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Shared\RelationManagers\AddressesRelationManager;

/**
 * Customer Entity.
 * This resource allows you to manage the global CRUD configuration.
 * 
 * @class CustomerResource
 * @package App\Filament\Resources
 */
class CustomerResource extends Resource
{
    /**
     * Get entity model.
     * 
     * @return string
     */
    public static function getModel(): string
    {
        return Customer::class;
    }

    /**
     * Get label.
     * 
     * @return string
     */
    public static function getLabel(): ?string
    {
        return trans_choice('entities.customers', 2);
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
        return 'heroicon-o-users';
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
                                        ->label(trans_choice('fields.name', 2))
                                        ->minLength(3)
                                        ->maxLength(255)
                                        ->required(),
                                    TextInput::make('last_name')
                                        ->label(trans_choice('fields.last_name', 2))
                                        ->minLength(3)
                                        ->maxLength(255)
                                        ->required(),
                                ])->columns(2),
                            Group::make()
                                ->schema([
                                    TextInput::make('email')
                                        ->label(trans_choice('fields.email', 1))
                                        ->minLength(5)
                                        ->maxLength(80)
                                        ->email()
                                        ->unique(ignoreRecord: true)
                                        ->required(),
                                    Group::make()
                                        ->schema([
                                            TextInput::make('phone')
                                                ->label(trans_choice('fields.phone', 1))
                                                ->minLength(5)
                                                ->maxLength(25)
                                                ->tel()
                                                ->unique(ignoreRecord: true),
                                            TextInput::make('mobile')
                                                ->label(trans_choice('fields.mobile', 1))
                                                ->minLength(5)
                                                ->maxLength(25)
                                                ->tel()
                                                ->unique(ignoreRecord: true)
                                                ->required(),
                                        ])
                                        ->columns(2),
                                ])
                                ->columns(2),
                            Group::make()
                                ->schema([
                                    DatePicker::make('birthday')
                                        ->label(trans_choice('fields.birthday', 1))
                                        ->native(false),
                                ])
                                ->columns(2),
                            Group::make()
                                ->schema([
                                    ToggleButtons::make('genre')
                                        ->label(trans_choice('fields.genre', 1))
                                        ->inline()
                                        ->options(Genre::class)
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
                                ->default(true)
                                ->required(),
                        ]),
                    Section::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->label(trans_choice('fields.created_at', 1))
                                ->content(fn (Customer $record): ?string => $record->created_at?->diffForHumans()),
                            Placeholder::make('updated_at')
                                ->label(trans_choice('fields.last_modified_on', 1))
                                ->content(fn (Customer $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Customer $record) => $record === null),
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
                ->label(trans_choice('fields.name', 2))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('last_name')
                ->label(trans_choice('fields.last_name', 2))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('mobile')
                ->label(trans_choice('fields.mobile', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('email')
                ->label(trans_choice('fields.email', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('genre')
                ->label(trans_choice('fields.genre', 1))
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
            AddressesRelationManager::class,
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
            'index'  => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit'   => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
