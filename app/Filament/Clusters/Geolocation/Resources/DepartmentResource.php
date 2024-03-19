<?php

namespace App\Filament\Clusters\Geolocation\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Department;
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
use App\Filament\Clusters\Geolocation\Resources\DepartmentResource\Pages;
use App\Filament\Clusters\Geolocation\Resources\DepartmentResource\RelationManagers\CitiesRelationManager;

/**
 * Department Entity.
 * This resource allows you to manage the global CRUD configuration.
 * 
 * @class DepartmentResource
 * @package App\Filament\Clusters\Geolocation\Resources
 */
class DepartmentResource extends Resource
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
        return Department::class;
    }

    /**
     * Get label.
     * 
     * @return string
     */
    public static function getLabel(): ?string
    {
        return trans_choice('entities.departments', 2);
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
     * Get shared form fields.
     * 
     * @return array
     */
    public static function getSharedFormFields(): array
    {
        return [
            Select::make('country_id')
                ->label(trans_choice('fields.country', 1))
                ->relationship('country', 'name')
                ->disabled(),
            TextInput::make('name')
                ->label(trans_choice('fields.department', 1))
                ->unique(ignoreRecord: true)
                ->disabled(),
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
                            Toggle::make('status')
                                ->label(trans_choice('fields.status', 1))
                                ->helperText(trans_choice('messages.helper_text_status', 1))
                                ->required(),
                        ]),
                    Section::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->label(trans_choice('fields.created_at', 1))
                                ->content(fn (Department $record): ?string => $record->created_at?->diffForHumans()),
                            Placeholder::make('updated_at')
                                ->label(trans_choice('fields.last_modified_on', 1))
                                ->content(fn (Department $record): ?string => $record->updated_at?->diffForHumans()),
                        ])
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Department $record) => $record === null),
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
    public static function getTableFilter(int $countryId = null): array
    {
        return [
            SelectFilter::make('country_id')
                ->label(trans_choice('fields.country', 1))
                ->native(false)
                ->searchable()
                ->optionsLimit(250)
                ->preload()
                ->default($countryId)
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
            CitiesRelationManager::class,
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
            'index'  => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit'   => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
