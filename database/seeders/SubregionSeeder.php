<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubregionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subregions')->delete();
        $subregions = [
            # Region asia
            ['id' => 1,  'name' => 'Asia Central',               'region_id' => 1, 'status' => true],
            ['id' => 2,  'name' => 'Asia Oriental',              'region_id' => 1, 'status' => true],
            ['id' => 3,  'name' => 'Sudeste asiático',           'region_id' => 1, 'status' => true],
            ['id' => 4,  'name' => 'Asia Meridional',            'region_id' => 1, 'status' => true],
            ['id' => 5,  'name' => 'Asia Occidental',            'region_id' => 1, 'status' => true],
            # Region Europe
            ['id' => 6,  'name' => 'Europa Central',             'region_id' => 2, 'status' => true],
            ['id' => 7,  'name' => 'Europa del Este',            'region_id' => 2, 'status' => true],
            ['id' => 8,  'name' => 'Norte de Europa',            'region_id' => 2, 'status' => true],
            ['id' => 9,  'name' => 'Sudeste de Europa',          'region_id' => 2, 'status' => true],
            ['id' => 10, 'name' => 'Europa del Sur',             'region_id' => 2, 'status' => true],
            ['id' => 11, 'name' => 'Europa Occidental',          'region_id' => 2, 'status' => true],
            # Region Africa
            ['id' => 12, 'name' => 'África Oriental',            'region_id' => 3, 'status' => true],
            ['id' => 13, 'name' => 'África Central',             'region_id' => 3, 'status' => true],
            ['id' => 14, 'name' => 'Norte de África',            'region_id' => 3, 'status' => true],
            ['id' => 15, 'name' => 'África Austral',             'region_id' => 3, 'status' => true],
            ['id' => 16, 'name' => 'África Occidental',          'region_id' => 3, 'status' => true],
            # Region Oceania
            ['id' => 17, 'name' => 'Australia y Nueva Zelanda', 'region_id' => 4, 'status' => true],
            ['id' => 18, 'name' => 'Melanesia',                 'region_id' => 4, 'status' => true],
            ['id' => 19, 'name' => 'Micronesia',                'region_id' => 4, 'status' => true],
            ['id' => 20, 'name' => 'Polinesia',                 'region_id' => 4, 'status' => true],
            # Region Americas
            ['id' => 21, 'name' => 'Caribe',                    'region_id' => 5, 'status' => true],
            ['id' => 22, 'name' => 'Centro América',            'region_id' => 5, 'status' => true],
            ['id' => 23, 'name' => 'Norteamérica',              'region_id' => 5, 'status' => true],
            ['id' => 24, 'name' => 'Sudamérica',                'region_id' => 5, 'status' => true],
        ];
        DB::table('subregions')->insert($subregions);
        DB::statement('SELECT setval(\'subregions_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM subregions), 1), false)');
    }
}
