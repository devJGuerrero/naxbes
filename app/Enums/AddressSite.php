<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Enums AddressSite.
 * 
 * @class   AddressSite
 * @package App\Enums
 */
enum AddressSite: string implements HasLabel
{
    case Home = 'home';
    case Office = 'office';
    case Other = 'other';

    /**
     * Get label.
     * 
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Home => trans_choice('fields.home', 1),
            self::Office => trans_choice('fields.office', 1),
            self::Other => trans_choice('fields.other', 1),
        };
    }
}
