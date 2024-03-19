<?php

namespace App\Models;

use App\Enums\CompanyEconomicActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nit', 'email', 'phone', 'fax', 'website',
        'country_id', 'department_id', 'city_id', 'address', 'economic_activity', 'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'economic_activity' => CompanyEconomicActivity::class,
    ];

    /**
     * Get the country that owns the company.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the department that owns the company.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the city that owns the company.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
