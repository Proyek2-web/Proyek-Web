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
            'status' => 'aktif',
            'category_id' => '2',
            'slug' => 'guci-kinasih',
            'harga' => '30000',
            'berat' => '500',
            'keterangan' => 'Guci Besar',
            'featured_image' => 'noimage.png',
            'video_product' => 'not.mp4',
            'video_product' => 'not.mp4',
        ]);
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
        Product::create([
            'nama' => 'Aksesoris Ciamik',
            'category_id' => '3',
            'status' => 'aktif',
            'slug' => 'aksesoris-bagus',
            'harga' => '30000',
            'berat' => '500',
            'keterangan' => 'Aksesors',
            'featured_image' => 'noimage.png',
            'video_product' => 'not.mp4',
        ]);

        Product::create([
            'nama' => 'Gelas Hias Kinasih ',
            'category_id' => '1',
            'status' => 'aktif',
            'slug' => 'gelas-hias-kinasih',
            'harga' => '20000',
            'berat' => '700',
            'keterangan' => 'Gelas Kecil',
            'featured_image' => 'noimage.png',
            'video_product' => 'not.mp4',
        ]);
        Product::create([
            'nama' => 'Gelas Ukir Kinasih ',
            'category_id' => '1',
            'status' => 'aktif',
            'slug' => 'gelas-ukir-kinasih',
            'berat' => '600',
            'harga' => '40000',
            'keterangan' => 'Gelas Ukir',
            'featured_image' => 'noimage.png',
            'video_product' => 'not.mp4',
        ]);
        Product::create([
            'nama' => 'Gelas Uhuy ',
            'category_id' => '1',
            'status' => 'aktif',
            'slug' => 'gelas-uhuy-kinasih',
            'berat' => '600',
            'harga' => '70000',
            'keterangan' => 'Gelas Uhuy',
            'featured_image' => 'noimage.png',
            'video_product' => 'not.mp4',
        ]);
        Product::create([
            'nama' => 'Gelas Cihuy ',
            'category_id' => '1',
            'status' => 'aktif',
            'slug' => 'gelas-cihuy-kinasih',
            'berat' => '600',
            'harga' => '90000',
            'keterangan' => 'Gelas Cihuy',
            'featured_image' => 'noimage.png',
            'video_product' => 'not.mp4',
        ]);
        Product::create([
            'nama' => 'Guci Ayy ',
            'category_id' => '2',
            'status' => 'nonaktif',
            'slug' => 'gucu-ukir-kinasih',
            'berat' => '600',
            'harga' => '90000',
            'keterangan' => 'Gelas Ukir',
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
            'name' => 'Syalwa',
            'email' => 'syalwa@gmail.com',
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