<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->delete();
        $customers = [
            [
                'id'        => 1,
                'name'      => 'Valentina',
                'last_name' => 'Linarez',
                'email'     => 'valentina.linarez@gmail.com',
                'phone'     => null,
                'mobile'    => 3105468493,
                'birthday'  => '1990/01/01',
                'genre'     => 'female',
            ],
            [
                'id'        => 2,
                'name'      => 'Lina',
                'last_name' => 'Menez',
                'email'     => 'lina.menez@gmail.com',
                'phone'     => null,
                'mobile'    => 3106468792,
                'birthday'  => '1990/01/01',
                'genre'     => 'female',
            ],
            [
                'id'        => 3,
                'name'      => 'Fabio',
                'last_name' => 'Peréz',
                'email'     => 'fabio.perez@gmail.com',
                'phone'     => null,
                'mobile'    => 3105468731,
                'birthday'  => '1990/01/01',
                'genre'     => 'male',
            ],
            [
                'id'        => 4,
                'name'      => 'Andrés',
                'last_name' => 'Gonzalez',
                'email'     => 'andres.gonzalez@gmail.com',
                'phone'     => null,
                'mobile'    => 3107469735,
                'birthday'  => '1990/01/01',
                'genre'     => 'male',
            ],
        ];
        DB::table('customers')->insert($customers);
        DB::statement('SELECT setval(\'customers_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM customers), 1), false)');
    }
}
