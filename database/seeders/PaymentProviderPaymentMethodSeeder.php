<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentProviderPaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_provider_payment_method')->delete();
        $paymentProviderPaymentMethods = [
            # bancolombia
            ['id' => 1, 'payment_provider_id' => 1, 'payment_method_id' => 1, 'status' => 1],
            ['id' => 2, 'payment_provider_id' => 1, 'payment_method_id' => 3, 'status' => 1],
            ['id' => 3, 'payment_provider_id' => 1, 'payment_method_id' => 4, 'status' => 1],
            ['id' => 4, 'payment_provider_id' => 1, 'payment_method_id' => 5, 'status' => 1],
            # davivienda
            ['id' => 5, 'payment_provider_id' => 2, 'payment_method_id' => 1, 'status' => 1],
            ['id' => 6, 'payment_provider_id' => 2, 'payment_method_id' => 3, 'status' => 1],
            ['id' => 7, 'payment_provider_id' => 2, 'payment_method_id' => 4, 'status' => 1],
            ['id' => 8, 'payment_provider_id' => 2, 'payment_method_id' => 5, 'status' => 1],
        ];
        DB::table('payment_provider_payment_method')->insert($paymentProviderPaymentMethods);
        DB::statement('SELECT setval(\'payment_provider_payment_method_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM payment_provider_payment_method), 1), false)');
    }
}
