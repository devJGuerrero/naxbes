<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wallets')->delete();
        $wallets = [
            ['id' => 1, 'name' => 'Nequi',       'country_id' => 47],
            ['id' => 2, 'name' => 'Daviplata',   'country_id' => 47],
            ['id' => 3, 'name' => 'Movii',       'country_id' => 47],
            ['id' => 4, 'name' => 'BBVA Wallet', 'country_id' => 47],
            ['id' => 5, 'name' => 'Powwi',       'country_id' => 47],
            ['id' => 6, 'name' => 'Rappi Pay',   'country_id' => 47],
        ];
        DB::table('wallets')->insert($wallets);
        DB::statement('SELECT setval(\'wallets_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM wallets), 1), false)');
    }
}
