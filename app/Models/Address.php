<?php

namespace App\Models;

use App\Enums\AddressSite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'zip', 'country_id', 'department_id', 'city_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'site' => AddressSite::class,
    ];

    public $timestamps = false;

    /**
     * Get the country that owns the address.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the department that owns the address.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the city that owns the address.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get all of the customers that are assigned this address.
     * 
     * @return MorphToMany<Customer>
     */
    public function customers(): MorphToMany
    {
        return $this->morphedByMany(Customer::class, 'addressable');
    }
}
