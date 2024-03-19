<?php

namespace App\Filament\Exports;

use App\Models\Country;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;

/**
 * Country Exporter.
 * 
 * @class CountryExporter
 * @package App\Filament\Exports
 */
class CountryExporter extends Exporter
{
    /**
     * Get model.
     * 
     * @return string
     */
    public static function getModel(): string
    {
        return Country::class;
    }

    /**
     * Get columns.
     * 
     * @return array
     */
    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('Id'),
            ExportColumn::make('name')
                ->label(
                    trans_choice(
                        'fields.country',
                        1
                    )
                ),
            ExportColumn::make('region.name')
                ->label(
                    trans_choice('fields.region', 1)
                ),
            ExportColumn::make('subregion.name')
                ->label(
                    trans_choice('fields.subregion', 1)
                ),
            ExportColumn::make('code')
                ->label(
                    trans_choice('fields.code_cca2', 1)
                ),
            ExportColumn::make('phone_code')
                ->label(
                    trans_choice('fields.area_code', 1)
                )
                ->prefix('+'),
            ExportColumn::make('status')
                ->label(
                    trans_choice('fields.status', 1)
                )
                ->formatStateUsing(
                    fn (string $state): string => $state === 'active' ? trans_choice('fields.active', 1) : trans_choice('fields.inactive', 1)
                ),
        ];
    }

    /**
     * Get completed notification body.
     * 
     * @return string
     */
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = trans_choice('messages.table_export_notification', 1, [
            'entity' => trans_choice('entities.countries', 2),
            'rows' => number_format($export->successful_rows)
        ]);
        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . trans_choice('messages.table_export_notification_failed', 1);
        }
        return $body;
    }
}
