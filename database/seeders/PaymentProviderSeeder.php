<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_providers')->delete();
        $paymentProviders = [
            ['id' => 1, 'name' => 'Bancolombia',   'type' => 'bank',   'country_id' => 47, 'status' => true],
            ['id' => 2, 'name' => 'Davivienda',    'type' => 'bank',   'country_id' => 47, 'status' => true],
            ['id' => 3, 'name' => 'Nequi',         'type' => 'wallet', 'country_id' => 47, 'status' => true],
            ['id' => 4, 'name' => 'Daviplata',     'type' => 'wallet', 'country_id' => 47, 'status' => true],
            ['id' => 5, 'name' => 'Contraentrega', 'type' => 'other',  'country_id' => 47, 'status' => true],
        ];
        DB::table('payment_providers')->insert($paymentProviders);
        DB::statement('SELECT setval(\'payment_providers_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM payment_providers), 1), false)');
    }
}
