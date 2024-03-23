<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->delete();
        $brands = [
            [
                'id'          => 1,
                'name'        => 'Yiwu YuanHeng Jewelry Co. Ltd',
                'slug'        => 'yiwu-yuanheng-jewelry-co-ltd',
                'website'     => 'https://zjyuanheng.en.alibaba.com',
                'description' => 'Yiwu YuanHeng Jewelry Co. Ltd es una empresa dedicada a la fabricación y distribución de joyería de alta calidad con sede en Yiwu, China. Con años de experiencia en la industria, nos hemos destacado por nuestra excelente artesanía, diseño innovador y compromiso con la satisfacción del cliente.',
                'is_visible'  => true,
            ],
        ];
        DB::table('brands')->insert($brands);
        DB::statement('SELECT setval(\'brands_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM brands), 1), false)');
    }
}
