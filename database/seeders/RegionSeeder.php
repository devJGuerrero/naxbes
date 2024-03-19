<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->delete();
        $regions = [
            ['id' => 1, 'name' => 'Asia',      'status' => true],
            ['id' => 2, 'name' => 'Europa',    'status' => true],
            ['id' => 3, 'name' => 'África',    'status' => true],
            ['id' => 4, 'name' => 'Oceanía',   'status' => true],
            ['id' => 5, 'name' => 'América',   'status' => true],
            ['id' => 6, 'name' => 'Antártida', 'status' => true],
        ];
        DB::table('regions')->insert($regions);
        DB::statement('SELECT setval(\'regions_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM regions), 1), false)');
    }
}
