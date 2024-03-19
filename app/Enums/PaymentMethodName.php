<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Enums PaymentMethodName.
 * 
 * @class   PaymentMethodName
 * @package App\Enums
 */
enum PaymentMethodName: string implements HasLabel
{
    case BankCheck = 'bank_check';
    case Cash = 'cash';
    case CreditCard = 'credit_card';
    case DebitCard = 'debit_card';
    case ElectronicTransfer = 'electronic_transfer';
    case VirtualWallet = 'virtual_wallet';

    /**
     * Get label.
     * 
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::BankCheck => trans_choice('fields.bank_check', 1),
            self::Cash => trans_choice('fields.cash', 1),
            self::CreditCard => trans_choice('fields.credit_card', 1),
            self::DebitCard => trans_choice('fields.debit_card', 1),
            self::ElectronicTransfer => trans_choice('fields.electronic_transfer', 1),
            self::VirtualWallet => trans_choice('fields.virtual_wallet', 1),
        };
    }
}
