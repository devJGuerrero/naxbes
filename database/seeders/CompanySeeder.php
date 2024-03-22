<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->delete();
        $companies = [
            [
                'id'                => 1,
                'name'              => 'Servientrega S.A',
                'nit'               => '860512330-3',
                'email'             => 'solucionesdigitales@servientrega.com',
                'phone'             => '6017700380',
                'fax'               => '',
                'website'           => 'https://www.servientrega.com/',
                'country_id'        => 47,
                'department_id'     => 779,
                'city_id'           => 12688,
                'address'           => 'Avenida 6 34A 11',
                'economic_activity' => 'transport',
                'status'            => true,
            ],
            [
                'id'                => 2,
                'name'              => 'Interrapidísimo',
                'nit'               => '8002515697',
                'email'             => 'tratamiento.datos.personales@interrapidisimo.com',
                'phone'             => '018000942777',
                'fax'               => '',
                'website'           => 'https://interrapidisimo.com/',
                'country_id'        => 47,
                'department_id'     => 779,
                'city_id'           => 12688,
                'address'           => 'Calle 18 65 A 03',
                'economic_activity' => 'transport',
                'status'            => true,
            ]
        ];
        DB::table('companies')->insert($companies);
        DB::statement('SELECT setval(\'companies_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM companies), 1), false)');
    }
}
