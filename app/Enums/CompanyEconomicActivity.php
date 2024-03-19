<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Enums CompanyEconomicActivity.
 * 
 * @class   CompanyEconomicActivity
 * @package App\Enums
 */
enum CompanyEconomicActivity: string implements HasLabel
{
    case Trade = 'trade';
    case Industry = 'industry';
    case Transport = 'transport';
    case OtherServices = 'other_services';

    /**
     * Get label.
     * 
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Trade => trans_choice('fields.trade', 1),
            self::Industry => trans_choice('fields.industry', 1),
            self::Transport => trans_choice('fields.transport', 1),
            self::OtherServices => trans_choice('fields.other_services', 1),
        };
    }
}
