<?php

namespace App\Models;

use App\Enums\PaymentProviderType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PaymentProvider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'country_id', 'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'type' => PaymentProviderType::class,
    ];

    /**
     * Get the country that owns the payment provider.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * The payment methods that belong to the payment provider.
     */
    public function paymentMethods(): BelongsToMany
    {
        return $this->belongsToMany(PaymentMethod::class, 'payment_provider_payment_method', 'payment_provider_id', 'payment_method_id')
            ->using(PaymentProviderPaymentMethod::class)->withPivot('status')
            ->withTimestamps();
    }
}
