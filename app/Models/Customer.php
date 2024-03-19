<?php

namespace App\Models;

use App\Enums\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'phone', 'mobile', 'birthday', 'genre', 'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'genre' => Genre::class,
    ];

    /**
     * Get all of the address for the customer.
     * 
     * @return MorphToMany<Address>
     */
    public function addresses(): MorphToMany
    {
        return $this->morphToMany(Address::class, 'addressable')
            ->withPivot(['site'])
            ->withTimestamps();
    }
}
