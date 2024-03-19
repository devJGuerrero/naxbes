<?php

namespace App\Models;

use App\Enums\PaymentMethodName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PaymentMethod extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name' => PaymentMethodName::class,
    ];

    /**
     * The banks that belong to the payment method.
     */
    public function banks(): BelongsToMany
    {
        return $this->belongsToMany(Bank::class, 'bank_payment_method', 'payment_method_id', 'bank_id')
            ->withPivot('status')
            ->using(
                BankPaymentMethod::class
            )
            ->withTimestamps();
    }

    /**
     * The wallets that belong to the payment method.
     */
    public function wallets(): BelongsToMany
    {
        return $this->belongsToMany(Wallet::class, 'wallet_payment_method', 'payment_method_id', 'wallet_id')
            ->withPivot('status')
            ->using(
                WalletPaymentMethod::class
            )
            ->withTimestamps();
    }

    /**
     * The payment providers that belong to the payment method.
     */
    public function paymentProviders(): BelongsToMany
    {
        return $this->belongsToMany(PaymentProvider::class, 'payment_provider_payment_method', 'payment_method_id', 'payment_provider_id')
            ->using(PaymentProviderPaymentMethod::class)->withPivot('status')
            ->withTimestamps();
    }
}
