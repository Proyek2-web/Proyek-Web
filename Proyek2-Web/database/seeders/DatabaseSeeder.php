<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
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

        // User::create([
        //     'name' => 'Priyandika',
        //     'email' => 'oniauliya99@gmail.com',
        //     'password' => '12345678',
        // ]);
        // User::create([
        //     'name' => 'Irfan',
        //     'email' => 'irfanasu@gmail.com',
        //     'password' => '123456789',
        // ]);
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