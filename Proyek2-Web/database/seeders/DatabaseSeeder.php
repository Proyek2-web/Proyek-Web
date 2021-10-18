<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
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
            'nama' => 'Gelas Hias Kinasih ',
            'category_id' => '1',
            'slug' => 'gelas-hias-kinasih',
            'harga' => '20000',
            'keterangan' => 'Gelas Kecil',
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
            'password' => Hash::make('kinasih123'),
        ]);
    }
}