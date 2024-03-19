<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status'
    ];

    /**
     * Get the countries for the region.
     */
    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }

    /**
     * Get the subregions for the region.
     */
    public function subregions(): HasMany
    {
        return $this->hasMany(Subregion::class);
    }
}
