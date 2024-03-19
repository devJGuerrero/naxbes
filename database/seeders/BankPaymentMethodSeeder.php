<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankPaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bank_payment_method')->delete();
        $id    = 1;
        $banks = DB::table('banks')->get();
        $bankPaymentMethods = [];
        foreach ($banks as $key => $bank) {
            $bankPaymentMethods[] = ['id' => $id++, 'bank_id' => $bank->id, 'payment_method_id' => 1];
            $bankPaymentMethods[] = ['id' => $id++, 'bank_id' => $bank->id, 'payment_method_id' => 3];
            $bankPaymentMethods[] = ['id' => $id++, 'bank_id' => $bank->id, 'payment_method_id' => 4];
            $bankPaymentMethods[] = ['id' => $id++, 'bank_id' => $bank->id, 'payment_method_id' => 5];
        }
        DB::table('bank_payment_method')->insert($bankPaymentMethods);
        DB::statement('SELECT setval(\'bank_payment_method_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM bank_payment_method), 1), false)');
    }
}
