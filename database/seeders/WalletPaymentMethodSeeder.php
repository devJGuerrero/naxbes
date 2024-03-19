<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletPaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wallet_payment_method')->delete();
        $id      = 1;
        $wallets = DB::table('wallets')->get();
        $walletPaymentMethods = [];
        foreach ($wallets as $key => $wallets) {
            $walletPaymentMethods[] = ['id' => $id++, 'wallet_id' => $wallets->id, 'payment_method_id' => 5];
            $walletPaymentMethods[] = ['id' => $id++, 'wallet_id' => $wallets->id, 'payment_method_id' => 6];
        }
        DB::table('wallet_payment_method')->insert($walletPaymentMethods);
        DB::statement('SELECT setval(\'wallet_payment_method_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM wallet_payment_method), 1), false)');
    }
}
