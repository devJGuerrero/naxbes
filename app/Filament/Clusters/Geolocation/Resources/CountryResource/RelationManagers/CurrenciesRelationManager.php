<?php

namespace App\Filament\Clusters\Geolocation\Resources\CountryResource\RelationManagers;

use Filament\Tables;
use App\Models\Currency;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Clusters\Parameter\Resources\CurrencyResource;

/**
 * Currencies Relation Manager.
 * 
 * @class CurrenciesRelationManager
 * @package App\Filament\Clusters\Geolocation\Resources\CountryResource\RelationManagers
 */
class CurrenciesRelationManager extends RelationManager
{
    /**
     * Get relationship name.
     * 
     * @return string
     */
    public static function getRelationshipName(): string
    {
        return 'currencies';
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
        return trans_choice('entities.currencies', 2);
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
                        ->schema(CurrencyResource::getSharedFormFields())
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
                            Placeholder::make('pivot.created_at')
                                ->label(trans_choice('fields.created_at', 1))
                                ->content(fn (Currency $record): ?string => $record->pivot->created_at?->diffForHumans()),
                            Placeholder::make('pivot.updated_at')
                                ->label(trans_choice('fields.last_modified_on', 1))
                                ->content(fn (Currency $record): ?string => $record->pivot->updated_at?->diffForHumans()),
                        ])
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Currency $record) => $record === null),
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
                array_merge(
                    CurrencyResource::getTableColumns(),
                    [
                        TextColumn::make('pivot.status')
                            ->label(trans_choice('fields.status', 1))
                            ->badge()
                            ->toggleable()
                            ->color(fn (string $state): string => $state ? 'success' : 'gray')
                            ->formatStateUsing(fn (string $state): string => $state ? trans_choice('fields.active', 1) : trans_choice('fields.inactive', 1)),
                    ]
                )
            )
            ->filters([
                SelectFilter::make('status')
                    ->label(trans_choice('fields.status', 1))
                    ->native(false)
                    ->options([
                        true => trans_choice('fields.active', 1),
                        false => trans_choice('fields.inactive', 1)
                    ]),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        Group::make()
                            ->schema([
                                $action->getRecordSelect(),
                                Toggle::make('status')
                                    ->label(trans_choice('fields.status', 1))
                                    ->helperText(trans_choice('messages.helper_text_status', 1))
                                    ->required()
                                    ->default(true),
                            ])
                            ->columns(2)
                    ])
                    ->modalHeading(trans_choice('entities.currencies', 2))
                    ->modalWidth('3xl')
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
