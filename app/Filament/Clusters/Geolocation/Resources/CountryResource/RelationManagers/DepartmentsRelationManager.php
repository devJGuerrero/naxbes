<?php

namespace App\Filament\Clusters\Geolocation\Resources\CountryResource\RelationManagers;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Department;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Clusters\Geolocation\Resources\DepartmentResource;

/**
 * Departments Relation Manager.
 * 
 * @class DepartmentsRelationManager
 * @package App\Filament\Resources\CountryResource\RelationManagers
 */
class DepartmentsRelationManager extends RelationManager
{
    /**
     * Set relationship.
     */
    protected static string $relationship = 'departments';

    /**
     * Get title.
     * 
     * @param Model $ownerRecord
     * @param string $pageClass
     * @return string
     */
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans_choice('fields.department', 2);
    }

    /**
     * Can create.
     * 
     * @return bool
     */
    public function canCreate(): bool
    {
        return false;
    }

    /**
     * Can delete.
     * 
     * @return bool
     */
    public function canDelete(Model $record): bool
    {
        return false;
    }

    /**
     * Can delete any.
     * 
     * @return bool
     */
    public function canDeleteAny(): bool
    {
        return false;
    }

    /**
     * Form configuration.
     * 
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form->schema([
            Group::make()
                ->schema([
                    Group::make()
                        ->schema(DepartmentResource::getSharedFormFields())
                        ->columns(2),
                ])
                ->columnSpan(['lg' => 3]),
            Group::make()
                ->schema([
                    Toggle::make('status')
                        ->label(trans_choice('fields.status', 1))
                        ->helperText(trans_choice('messages.helper_text_status', 1))
                        ->required(),
                    Group::make()
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
            ->paginated([7, 10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(7)
            ->recordTitleAttribute('name')
            ->columns(
                DepartmentResource::getTableColumns()
            )
            ->filters(
                DepartmentResource::getTableFilter($this->ownerRecord->id)
            )
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalHeading(
                        trans_choice('messages.action_create_form', 1, [
                            'entity' => trans_choice('fields.department', 1)
                        ])
                    )
                    ->label(
                        trans_choice('messages.action_create_form', 1, [
                            'entity' => trans_choice('fields.department', 1)
                        ])
                    ),
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
