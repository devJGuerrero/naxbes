<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->delete();
        $categories = [
            [
                'id'          => 1,
                'name'        => 'Damas',
                'slug'        => 'damas',
                'parent_id'   => null,
                'description' => 'Descubre nuestra cautivadora colección para damas, cuidadosamente seleccionada para satisfacer tus deseos de estilo y elegancia. Desde prendas clásicas hasta las últimas tendencias de la moda, nuestra amplia gama de opciones te ofrece la oportunidad de expresar tu personalidad única con confianza y estilo. Confeccionadas con los mejores materiales y atención al detalle, nuestras prendas aseguran un ajuste perfecto y una comodidad incomparable en cada ocasión. Ya sea que estés buscando un conjunto para la oficina, un atuendo para una ocasión especial o simplemente prendas versátiles para tu guardarropa diario, nuestra colección tiene todo lo que necesitas para destacar con elegancia en cada paso que des. Sumérgete en la belleza y la sofisticación de nuestra selección y descubre la magia de ser una mujer bien vestida en cada momento de tu vida.',
                'is_visible'  => true,
            ],
            [
                'id'          => 2,
                'name'        => 'Caballeros',
                'slug'        => 'caballeros',
                'parent_id'   => null,
                'description' => 'Explora nuestra distinguida colección para caballeros, cuidadosamente elaborada para satisfacer tus exigencias de estilo y funcionalidad. Desde trajes clásicos hasta conjuntos casuales y modernos, nuestra selección ofrece una variedad de opciones diseñadas para complementar tu personalidad y reflejar tu estilo único. Confeccionadas con materiales de primera calidad y atención meticulosa a los detalles, nuestras prendas garantizan un ajuste impecable y una comodidad excepcional en cada ocasión. Ya sea que busques un atuendo para la oficina, un conjunto elegante para una ocasión especial o prendas versátiles para tu estilo de vida activo, nuestra colección ofrece todo lo necesario para que te sientas seguro y elegante en cualquier situación. Sumérgete en la sofisticación y el encanto de nuestra selección y descubre el placer de vestir con estilo en cada paso que des.',
                'is_visible'  => true,
            ],
            [
                'id'          => 3,
                'name'        => 'Niños',
                'slug'        => 'ninos',
                'parent_id'   => null,
                'description' => 'Explora nuestra emocionante colección para niños, diseñada para acompañarlos en sus aventuras diarias con estilo y confort. Desde prendas vibrantes y divertidas hasta conjuntos versátiles y prácticos, nuestra selección ofrece una amplia gama de opciones para satisfacer los gustos y necesidades de los más pequeños. Confeccionadas con materiales duraderos y de alta calidad, nuestras prendas garantizan libertad de movimiento y resistencia para acompañar el ritmo activo de los niños. Ya sea que estén explorando el mundo exterior o disfrutando de actividades en casa, nuestra colección ofrece todo lo necesario para que los niños se sientan seguros y felices en cada momento. Sumérgete en la diversión y la creatividad de nuestra selección y descubre la alegría de vestir a los niños con prendas que reflejan su energía y personalidad única.',
                'is_visible'  => true,
            ],
            [
                'id'          => 4,
                'name'        => 'Niñas',
                'slug'        => 'ninas',
                'parent_id'   => null,
                'description' => 'Descubre nuestra encantadora colección para niñas, cuidadosamente creada para inspirar su imaginación y realzar su estilo con gracia y dulzura. Desde vestidos de princesa hasta conjuntos casuales y modernos, nuestra selección ofrece una amplia variedad de opciones para satisfacer los gustos y personalidades de las pequeñas fashionistas. Confeccionadas con telas suaves y detalles encantadores, nuestras prendas garantizan comodidad y estilo en cada paso. Ya sea que estén jugando en el parque o asistiendo a una ocasión especial, nuestra colección ofrece todo lo necesario para que las niñas se sientan seguras y hermosas en cualquier momento. Sumérgete en la magia y la diversión de nuestra selección y descubre la alegría de vestir a las niñas con prendas diseñadas para despertar su imaginación y celebrar su belleza única.',
                'is_visible'  => true,
            ],
            [
                'id'          => 5,
                'name'        => 'Bebés',
                'slug'        => 'bebes',
                'parent_id'   => null,
                'description' => 'Explora nuestra adorable colección para bebés, cuidadosamente diseñada para brindar comodidad y estilo desde los primeros días de vida. Desde prendas suaves y acogedoras hasta conjuntos encantadores y funcionales, nuestra selección ofrece una amplia variedad de opciones para satisfacer las necesidades de los más pequeños. Confeccionadas con materiales seguros y de alta calidad, nuestras prendas garantizan la máxima comodidad y protección para la delicada piel de tu bebé. Ya sea que estés buscando un conjunto para una ocasión especial o prendas versátiles para el día a día, nuestra colección ofrece todo lo necesario para vestir a tu pequeño con estilo y dulzura. Sumérgete en la ternura y la alegría de nuestra selección y descubre la magia de vestir a tu bebé con prendas diseñadas con amor y cuidado.',
                'is_visible'  => true,
            ],
            [
                'id'          => 6,
                'name'        => 'Accesorios',
                'slug'        => 'accesorios',
                'parent_id'   => 1,
                'description' => 'Descubre nuestra exquisita colección de accesorios para damas, diseñada para realzar tu estilo con elegancia y distinción. Desde delicados collares hasta elegantes pulseras, nuestra selección ofrece una amplia variedad de opciones para complementar cualquier atuendo y ocasión. Confeccionados con materiales de primera calidad y atención al detalle, nuestros accesorios garantizan un acabado impecable y un estilo único. Ya sea que busques un toque de glamour para una salida nocturna o un toque de sofisticación para el día a día, nuestra colección tiene todo lo que necesitas para expresar tu individualidad y destacar tu belleza natural. Explora nuestra gama de colores, diseños y estilos para encontrar el accesorio perfecto que refleje tu personalidad y realce tu encanto personal en cada ocasión.',
                'is_visible'  => true,
            ],
            [
                'id'          => 7,
                'name'        => 'Diademas',
                'slug'        => 'diademas',
                'parent_id'   => 6,
                'description' => 'Descubre nuestra exclusiva colección de diademas diseñadas para destacar tu estilo con elegancia y comodidad. Desde diseños clásicos hasta opciones modernas y chic, nuestras diademas están elaboradas con materiales de alta calidad para garantizar durabilidad y confort. Ya sea que desees agregar un toque de glamour a tu look diario o complementar un atuendo para una ocasión especial, nuestras diademas ofrecen la combinación perfecta de estilo y practicidad. Explora nuestra variedad de colores, estampados y adornos para encontrar la diadema ideal que refleje tu personalidad única y realce tu belleza con cada uso.',
                'is_visible'  => true,
            ],
            [
                'id'          => 8,
                'name'        => 'Ropa',
                'slug'        => 'ropa',
                'parent_id'   => 1,
                'description' => 'Explora nuestra cautivadora colección de ropa para damas, donde el estilo se encuentra con la comodidad en cada prenda. Desde elegantes vestidos hasta conjuntos casuales y versátiles, nuestra amplia selección ofrece opciones para cada ocasión y cada estilo personal. Confeccionadas con los materiales más finos y diseñadas con atención meticulosa a los detalles, nuestras prendas garantizan un ajuste perfecto y una sensación de lujo en cada uso. Ya sea que estés buscando un atuendo para el trabajo, una salida informal con amigos o una ocasión especial, nuestra colección te ofrece las últimas tendencias de la moda combinadas con la calidad y la elegancia que mereces. Sumérgete en la sofisticación y la versatilidad de nuestra selección y descubre cómo nuestra ropa puede realzar tu belleza y confianza en cualquier momento.',
                'is_visible'  => true,
            ],
            [
                'id'          => 9,
                'name'        => 'Jeans',
                'slug'        => 'jeans',
                'parent_id'   => 8,
                'description' => 'Sumérgete en nuestra extraordinaria selección de jeans para damas y descubre el equilibrio perfecto entre comodidad y estilo. Desde los clásicos skinny hasta los modernos boyfriend, nuestra colección presenta una variedad de cortes, lavados y detalles para adaptarse a cualquier gusto y ocasión. Confeccionados con tejidos de alta calidad y atención meticulosa a los detalles, nuestros jeans ofrecen un ajuste impecable que realza tu figura y te hace sentir segura en cada paso. Ya sea que estés buscando un look casual para el día a día o un estilo más sofisticado para una noche especial, nuestros jeans son la opción ideal para completar tu guardarropa con versatilidad y elegancia. Explora nuestra gama de colores y acabados para encontrar el par perfecto que se adapte a tu estilo único y te acompañe en cada aventura con confianza y estilo.',
                'is_visible'  => true,
            ],
            [
                'id'          => 10,
                'name'        => 'Vestidos',
                'slug'        => 'vestidos',
                'parent_id'   => 8,
                'description' => 'Descubre nuestra exquisita selección de vestidos, diseñados para deleitar tus sentidos y realzar tu belleza en cada ocasión. Desde elegantes vestidos de cóctel hasta cautivadores vestidos de noche, nuestra colección abarca una amplia gama de estilos, colores y cortes para satisfacer todos tus gustos y preferencias. Confeccionados con telas de alta calidad y atención meticulosa a los detalles, nuestros vestidos ofrecen un ajuste impecable y una sensación de lujo incomparable. Ya sea que estés buscando un look sofisticado para una fiesta formal o un vestido más casual para una salida de fin de semana, encontrarás la pieza perfecta que te hará destacar entre la multitud. Déjate envolver por la elegancia y el encanto de nuestros vestidos y haz una declaración de estilo que perdure en el tiempo.',
                'is_visible'  => true,
            ],
        ];
        DB::table('categories')->insert($categories);
        DB::statement('SELECT setval(\'categories_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM categories), 1), false)');
    }
}
