<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Enums Genre.
 * 
 * @class   Genre
 * @package App\Enums
 */
enum Genre: string implements HasLabel
{
    case Male = 'male';
    case Female = 'female';
    case Other = 'other';

    /**
     * Get label.
     * 
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Male => trans_choice('fields.male', 1),
            self::Female => trans_choice('fields.female', 1),
            self::Other => trans_choice('fields.other', 1),
        };
    }
}
