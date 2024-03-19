<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'phone_code', 'region_id', 'subregion_id', 'currency_id', 'status'
    ];

    /**
     * Get the region that owns the country.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the subregion that owns the country.
     */
    public function subregion(): BelongsTo
    {
        return $this->belongsTo(Subregion::class);
    }

    /**
     * Get the departments for the country.
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    /**
     * Get the currency that owns the country.
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * The currencies that belong to the country.
     */
    public function currencies(): BelongsToMany
    {
        return $this->belongsToMany(Currency::class)
            ->using(CountryCurrency::class)
            ->withPivot('status')
            ->withTimestamps();
    }
}
