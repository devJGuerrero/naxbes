<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Enums PaymentProviderType.
 * 
 * @class   PaymentProviderType
 * @package App\Enums
 */
enum PaymentProviderType: string implements HasLabel
{
    case Bank = 'bank';
    case Wallet = 'wallet';
    case Other = 'other';

    /**
     * Get label.
     * 
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Bank => trans_choice('fields.bank', 1),
            self::Wallet => trans_choice('fields.wallet', 1),
            self::Other => trans_choice('fields.other', 1),
        };
    }
}
