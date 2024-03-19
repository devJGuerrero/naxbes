<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banks')->delete();
        $banks = [
            ['id' => 1, 'name' => 'Bancolombia',         'country_id' => 47],
            ['id' => 2, 'name' => 'Davivienda',          'country_id' => 47],
            ['id' => 3, 'name' => 'AV Villas',           'country_id' => 47],
            ['id' => 4, 'name' => 'Caja Social',         'country_id' => 47],
            ['id' => 5, 'name' => 'Agrario de Colombia', 'country_id' => 47],
            ['id' => 6, 'name' => 'Banco de Occidente',  'country_id' => 47],
            ['id' => 7, 'name' => 'Itaú',                'country_id' => 47],
            ['id' => 8, 'name' => 'Pichincha',           'country_id' => 47],
            ['id' => 9, 'name' => 'Banco Popular',       'country_id' => 47],
        ];
        DB::table('banks')->insert($banks);
        DB::statement('SELECT setval(\'banks_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM banks), 1), false)');
    }
}
