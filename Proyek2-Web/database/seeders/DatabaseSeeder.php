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
            'nama' => 'Guci Bagus',
            'status' => 'aktif',
            'category_id' => '2',
            'slug' => 'guci-bagus',
            'harga' => '30000',
            'berat' => '400',
            'keterangan' => 'Guci Bagus',
            'featured_image' => 'noimage.png',
            'video_product' => 'not.mp4',
        ]);
        Product::create([
            'nama' => 'Aksesoris',
            'category_id' => '3',
            'status' => 'aktif',
            'slug' => 'aksesoris',
            'harga' => '30000',
            'berat' => '300',
            'keterangan' => 'Aksesors',
            'featured_image' => 'noimage.png',
            'video_product' => 'not.mp4',
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
        User::create([
            'name' => 'Irfan harfiansyah',
            'email' => 'irfan@gmail.com',
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