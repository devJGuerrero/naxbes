<?php

namespace App\Filament\Clusters\Parameter\Resources;

use Filament\Tables;
use App\Models\Currency;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Parameter;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use App\Filament\Clusters\Parameter\Resources\CurrencyResource\Pages;

/**
 * Currency Entity.
 * This resource allows you to manage the global CRUD configuration.
 * 
 * @class CurrencyResource
 * @package App\Filament\Clusters\Parameter\Resources
 */
class CurrencyResource extends Resource
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
        return Currency::class;
    }

    /**
     * Get label.
     * 
     * @return string
     */
    public static function getLabel(): ?string
    {
        return trans_choice('entities.currencies', 2);
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
     * Can edit.
     * 
     * @return bool
     */
    public static function canEdit(Model $record): bool
    {
        return false;
    }

    /**
     * Can view.
     * 
     * @return bool
     */
    public static function canView(Model $record): bool
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
     * Get shared form fields.
     * 
     * @return array
     */
    public static function getSharedFormFields(): array
    {
        return [
            TextInput::make('name')
                ->label(trans_choice('fields.currency', 1))
                ->required()
                ->disabledOn('edit')
                ->unique(ignoreRecord: true)
                ->minLength(3)
                ->maxLength(255),
            TextInput::make('code')
                ->label(trans_choice('fields.code', 1))
                ->required()
                ->unique(ignoreRecord: true)
                ->disabledOn('edit')
                ->minLength(2)
                ->maxLength(3),
            TextInput::make('symbol')
                ->label(trans_choice('fields.symbol', 1))
                ->required()
                ->disabledOn('edit')
                ->minLength(1)
                ->maxLength(6),
        ];
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
                                ->schema(static::getSharedFormFields())
                                ->columns(2)
                        ]),
                ])
                ->columnSpan(['lg' => 3]),
            Group::make()
                ->schema([
                    Section::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->label(trans_choice('fields.created_at', 1))
                                ->content(fn (Currency $record): ?string => $record->created_at?->diffForHumans()),
                            Placeholder::make('updated_at')
                                ->label(trans_choice('fields.last_modified_on', 1))
                                ->content(fn (Currency $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Currency $record) => $record === null),
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
                ->label(trans_choice('fields.currency', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('code')
                ->label(trans_choice('fields.code', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('symbol')
                ->label(trans_choice('fields.symbol', 1))
                ->sortable()
                ->toggleable()
                ->searchable(),
        ];
    }

    /**
     * Get table filter.
     * 
     * @return array
     */
    public static function getTableFilter(): array
    {
        return [];
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
            'index'  => Pages\ListCurrencies::route('/'),
            'create' => Pages\CreateCurrency::route('/create'),
            'edit'   => Pages\EditCurrency::route('/{record}/edit'),
        ];
    }
}
