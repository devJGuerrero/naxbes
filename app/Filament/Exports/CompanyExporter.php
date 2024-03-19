<?php

namespace App\Filament\Exports;

use App\Models\Company;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;

/**
 * Company Exporter.
 * 
 * @class CompanyExporter
 * @package App\Filament\Exports
 */
class CompanyExporter extends Exporter
{
    /**
     * Get model.
     * 
     * @return string
     */
    public static function getModel(): string
    {
        return Company::class;
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
                        'fields.company',
                        1
                    )
                ),
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
            'entity' => trans_choice('entities.companies', 2),
            'rows' => number_format($export->successful_rows)
        ]);
        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . trans_choice('messages.table_export_notification_failed', 1);
        }
        return $body;
    }
}
