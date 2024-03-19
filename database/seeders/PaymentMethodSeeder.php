<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->delete();
        $paymentMethods = [
            ['id' => 1, 'name' => 'bank_check'],
            ['id' => 2, 'name' => 'cash'],
            ['id' => 3, 'name' => 'credit_card'],
            ['id' => 4, 'name' => 'debit_card'],
            ['id' => 5, 'name' => 'electronic_transfer'],
            ['id' => 6, 'name' => 'virtual_wallet'],
        ];
        DB::table('payment_methods')->insert($paymentMethods);
        DB::statement('SELECT setval(\'payment_methods_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM payment_methods), 1), false)');
    }
}
