<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Currency extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'symbol',
    ];

    /**
     * The countries that belong to the currency.
     */
    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class)
            ->using(CountryCurrency::class)->withPivot('status')
            ->withTimestamps();
    }
}
