<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

/**
 * Enums Status.
 * 
 * @class   Status
 * @package App\Enums
 */
enum Status: string implements HasLabel, HasColor
{
    case Active = 'active';
    case Inactive = 'inactive';

    /**
     * Get label.
     * 
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Active => trans_choice('fields.active', 1),
            self::Inactive => trans_choice('fields.inactive', 1),
        };
    }

    /**
     * Get color
     * 
     * @return string
     */
    public function getColor(): string
    {
        return match ($this) {
            self::Active => 'success',
            self::Inactive => 'gray',
        };
    }
}
