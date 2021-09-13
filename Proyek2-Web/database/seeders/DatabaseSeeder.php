<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

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
        Product::create([
            'nama' => 'Guci Kinasih',
            'harga' => '120000',
            'keterangan' => 'Berat 12 kg',
            'featured_image' => 'logo.jpg'

        ]);
        Product::create([
            'nama' => 'Gelas',
            'harga' => '120000',
            'keterangan' => 'Berat 12 kg',
            'featured_image' => 'logo.jpg'

        ]);
    }
}