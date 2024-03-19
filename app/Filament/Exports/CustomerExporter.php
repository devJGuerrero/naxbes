<?php

namespace App\Filament\Exports;

use App\Enums\Genre;
use App\Models\Customer;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;

/**
 * Customer Exporter.
 * 
 * @class CustomerExporter
 * @package App\Filament\Exports
 */
class CustomerExporter extends Exporter
{
    /**
     * Get model.
     * 
     * @return string
     */
    public static function getModel(): string
    {
        return Customer::class;
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
                ->label(trans_choice('fields.name', 1)),
            ExportColumn::make('last_name')
                ->label(trans_choice('fields.last_name', 1)),
            ExportColumn::make('email')
                ->label(trans_choice('fields.email', 1)),
            ExportColumn::make('phone')
                ->label(trans_choice('fields.phone', 1)),
            ExportColumn::make('mobile')
                ->label(trans_choice('fields.mobile', 1)),
            ExportColumn::make('birthday')
                ->label(trans_choice('fields.birthday', 1)),
            ExportColumn::make('genre')
                ->label(trans_choice('fields.genre', 1))
                ->formatStateUsing(function (Genre $state): string {
                    return match ($state) {
                        Genre::Male   => trans_choice('fields.male',   1),
                        Genre::Female => trans_choice('fields.female', 1),
                        Genre::Other  => trans_choice('fields.other',  1),
                    };
                }),
            ExportColumn::make('status')
                ->label(trans_choice('fields.status', 1))
                ->formatStateUsing(
                    fn (bool $state): string => $state ? trans_choice('fields.active', 1) : trans_choice('fields.inactive', 1)
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
            'entity' => trans_choice('entities.customers', 2),
            'rows' => number_format($export->successful_rows)
        ]);
        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . trans_choice('messages.table_export_notification_failed', 1);
        }
        return $body;
    }
}
