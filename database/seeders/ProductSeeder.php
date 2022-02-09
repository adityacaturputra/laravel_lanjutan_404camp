<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Faker::create('id_ID');

        $categories = ['Pakaian', 'Gadget', 'Digital'];
        $titles = [
            'Pakaian' => [
                'material' => ['Kaos', 'Kemeja', 'Celana', 'Jas'],
                'jenis' => ['Besar', 'Kecil', 'Anak', 'Laki-laki', 'Perempuan'],
                'warna' => ['putih', 'merah', 'biru', 'kuning', 'pink', 'ungu', 'hitam'],
            ],
            'Gadget' => [
                'material' => ['HP', 'Tablet', 'Laptop', 'PC', 'Mini Pc'],
                'jenis' => ['Asus', 'Lenovo', 'Acer', 'Polytron', 'Xiaomi'],
                'warna' => ['putih', 'merah', 'biru', 'kuning', 'pink', 'ungu', 'hitam'],
            ],
            'Digital' => [
                'material' => ['Pulsa', 'Kuota', 'Perdana'],
                'jenis' => ['Telkomsel', 'Tri', 'Im3', 'Axis', 'XL'],
                'warna' => ['100', '50', '20', '10', '5'],
            ],
        ];
        for ($i=1; $i <= 100; $i++) { 
            $category = $fake->randomElement($categories);
            $titleStr = $fake->randomElement($titles[$category]['material']).' '.
                $fake->randomElement($titles[$category]['jenis']).' '.
                $fake->randomElement($titles[$category]['warna']);

            $data[] = [
                'category' => $category,
                'title' => $titleStr,
                'price' => $fake->numberBetween(1,100)*1000,
                'descriptions' => $fake->text(),
                'stock' => $fake->numberBetween(1,200),
                'free_shipping' => $fake->numberBetween(0,1),
                'rate' => $fake->randomFloat(2,1,5)       
            ];
        }
        (new Product())->insert($data);
    }
}
