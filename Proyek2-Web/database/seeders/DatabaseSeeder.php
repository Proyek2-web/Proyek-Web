<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Product;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Models\Province;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Product::create([
        //     'nama' => 'Guci Kinasih',
        //     'harga' => '120000',
        //     'keterangan' => 'Berat 12 kg',
        //     'featured_image' => 'logo.jpg'

        // ]);
        // Product::create([
        //     'nama' => 'Gelas',
        //     'harga' => '120000',
        //     'keterangan' => 'Berat 12 kg',
        //     'featured_image' => 'logo.jpg'

        // ]);

        Product::create([
            'nama' => 'Guci ',
            'category_id' => '2',
            'slug' => 'guci-kinasih',
            'harga' => '30000',
            'keterangan' => 'Guci Besar',
            'featured_image' => 'imgaaa.jpg',
        ]);
        Product::create([
            'nama' => 'Guci Bagus',
            'category_id' => '2',
            'slug' => 'guci-bagus',
            'harga' => '30000',
            'keterangan' => 'Guci Bagus',
            'featured_image' => 'imgaaa.jpg',
        ]);
        Product::create([
            'nama' => 'Aksesoris',
            'category_id' => '3',
            'slug' => 'aksesoris',
            'harga' => '30000',
            'keterangan' => 'Aksesors',
            'featured_image' => 'imgaaa.jpg',
        ]);
        Product::create([
            'nama' => 'Aksesoris Ciamik',
            'category_id' => '3',
            'slug' => 'aksesoris-bagus',
            'harga' => '30000',
            'keterangan' => 'Aksesors',
            'featured_image' => 'imgaaa.jpg',
        ]);

        Product::create([
            'nama' => 'Gelas Hias Kinasih ',
            'category_id' => '1',
            'slug' => 'gelas-hias-kinasih',
            'harga' => '20000',
            'keterangan' => 'Gelas Kecil',
            'featured_image' => 'img.jpg',
        ]);
        Product::create([
            'nama' => 'Gelas Ukir Kinasih ',
            'category_id' => '1',
            'slug' => 'gelas-ukir-kinasih',
            'harga' => '40000',
            'keterangan' => 'Gelas Ukir',
            'featured_image' => 'img.jpg',
        ]);
        Category::create([
            'name' => 'Gelas',
            'slug' => 'kinasih-gelas',
        ]);
        Category::create([
            'name' => 'Guci',
            'slug' => 'kinasih-guci',
        ]);
        Category::create([
            'name' => 'Aksesoris',
            'slug' => 'kinasih-aksesoris',
        ]);
        User::create([
            'name' => 'Kinasih',
            'email' => 'kinasih@gmail.com',
            'roles' => 'admin', 
            'no_hp' => '089221231889',
            'password' => Hash::make('kinasih123'),
        ]);
        User::create([
            'name' => 'Oni',
            'email' => 'oni@gmail.com',
            'roles' => 'user',
            'no_hp' => '089221231889', 
            'password' => Hash::make('kinasih123'),
        ]);
        
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinceRow) {
            Province::create([
                'province_id' => $provinceRow['province_id'],
                'name'        => $provinceRow['province'],
            ]);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinceRow['province_id'])->get();
            foreach ($daftarKota as $cityRow) {
                City::create([
                    'province_id'   => $provinceRow['province_id'],
                    'city_id'       => $cityRow['city_id'],
                    'name'          => $cityRow['city_name'],
                ]);
            }
        }
    }
        
}