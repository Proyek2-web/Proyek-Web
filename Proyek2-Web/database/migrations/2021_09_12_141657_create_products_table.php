<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('category_id');
            $table->string('slug');
            $table->integer('berat')->nullable();
            $table->integer('panjang')->nullable();
            $table->integer('lebar')->nullable();
            $table->integer('tinggi')->nullable();
            $table->integer('diskon')->nullable();
            $table->integer('harga');
            $table->integer('stok')->nullable();
            $table->string('status')->nullable();
            $table->string('status_produk')->nullable();
            $table->text('keterangan');
            $table->string('featured_image');
            $table->string('video_product');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}